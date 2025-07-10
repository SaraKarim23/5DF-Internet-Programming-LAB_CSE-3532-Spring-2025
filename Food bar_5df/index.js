const express = require('express');
const cors = require('cors');
require('dotenv').config()
const jwt=require('jsonwebtoken')
const cookieParser=require('cookie-parser')
const { MongoClient, ServerApiVersion, ObjectId } = require('mongodb');
const port = process.env.PORT || 5000;
const app = express()

const corsOptions={
    origin:['http://localhost:5173'],
    credentials:true,
    optionSuccessStatus:200,
}
app.use(cors(corsOptions))
app.use(express.json())
app.use(cookieParser())

// verify jwt middleware
const verifyToken=(req,res,next)=>{
    const token = req.cookies?.token;
    if(!token){
      return res.status(401).send({message:'unauthorized access'})
    }
    if(token){
      jwt.verify(token,process.env.ACCESS_TOKEN_SECRET,(err,decoded)=>{
        if(err){
          return res.status(403).send({message:'forbidden access'})
        }
        req.user=decoded;
        next()
      })
    }
}


const uri = `mongodb+srv://${process.env.DB_USER}:${process.env.DB_PASS}@cluster0.5z0uxc8.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0`;

// Create a MongoClient with a MongoClientOptions object to set the Stable API version
const client = new MongoClient(uri, {
  serverApi: {
    version: ServerApiVersion.v1,
    strict: true,
    deprecationErrors: true,
  }
});

async function run() {
  try { 

    const foodsCollection=client.db('YumHub').collection('foods')
    const RequestCollection=client.db('YumHub').collection('RequestFoods')

        // jwt generate
    app.post('/jwt',async(req,res)=>{
        const email=req.body;
        const token=jwt.sign(email,process.env.ACCESS_TOKEN_SECRET,{
            expiresIn:'7d'
        })
        res.cookie('token',token,{
            httpOnly:true,
            secure: process.env.NODE_ENV==='production',
            sameSite: process.env.NODE_ENV==='production' ? 'none' : 'strict'
        }).send({success: true})
    })
      
    app.post('/logout',(req,res)=>{
      res.
      clearCookie('token',{
         httpOnly:true,
         secure: true,
         sameSite: process.env.NODE_ENV==='production' ? 'none' : 'strict',
         maxAge:0,
      })
       .send({success: true})
   })
      
    // CRUD Operation of FoodCollection
    app.post('/food',async(req,res)=>{
        const foodData=req.body;
        const result = await foodsCollection.insertOne(foodData)
        res.send(result)
    })

    app.get('/foods',async(req,res)=>{
        const cursor=foodsCollection.find({ status: "available" }).sort({quantity:-1});
        const result = await cursor.toArray();
        res.send(result)
        
    })

    app.get('/foods/:email',verifyToken,async(req,res)=>{
      const tokenEmail=req.user.email
      const email=req.params.email;
      if(tokenEmail !== email){
         return res.status(403).send({message:'forbidden access'})
      }
      const query={'donar.email':email}
      const result = await foodsCollection.find(query).toArray()
      res.send(result)
    })

    app.get('/food/:id',async(req,res)=>{
        const id=req.params.id;
        const query={_id:new ObjectId(id)}
        const result = await foodsCollection.findOne(query)
        res.send(result)
    })

    app.delete('/food/:id',async(req,res)=>{
      const id=req.params.id;
      const query={_id:new ObjectId(id)}
      const result = await foodsCollection.deleteOne(query)
      res.send(result)
    })

    app.put('/update-food/:id',async(req,res)=>{
      const id=req.params.id;
      const query={_id:new ObjectId(id)}
      const FoodData=req.body
      const options={upsert:true}
      const updateDoc = {
        $set:{
          ...FoodData,
        },
      }
      const result = await foodsCollection.updateOne(query,updateDoc,options)
      res.send(result)
    })

    app.patch('/food/:id',async(req,res)=>{
      const id=req.params.id;
      const status=req.body;
      const query={_id:new ObjectId(id)}
      const updateDoc={
        $set: status
      }
      const result = await foodsCollection.updateOne(query,updateDoc)
      res.send(result)
    })

    app.get('/all-foods',async(req,res)=>{
      const sort=req.query.sort;
      const search=req.query.search;
  
      let query={
        food_name:{ $regex:search, $options: 'i'}
      }

      let options={}
      if(sort){
        options={sort:{expired_date:sort==='asc' ? 1 : -1}}
      }
      
      const cursor=foodsCollection.find({...query,status: "available" },options);
      const result = await cursor.toArray();
      res.send(result)
    })
  

    // CRUD Operation of Requested Collection
    app.post('/Req-Food',async(req,res)=>{
      const RequestData=req.body;
      const result = await RequestCollection.insertOne(RequestData)
      res.send(result)
    })

   app.get('/my-requests/:email',verifyToken,async(req,res)=>{
      const email=req.params.email;
      const query={email}
      const result = await RequestCollection.find(query).toArray()
      res.send(result)
    })


    // await client.db("admin").command({ ping: 1 });
    console.log("Pinged your deployment. You successfully connected to MongoDB!");
  } finally {
    // Ensures that the client will close when you finish/error
  }
}
run().catch(console.dir);


app.get('/',(req,res)=>{
    res.send('YumHub is cooking')
})

app.listen(port,()=>{
    console.log(`server is running on port , ${port}`)
})
