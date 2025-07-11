// ✅ Full server.js with login/signup, session tracking, and PDF download
const stripe = require('stripe')('your_stripe_secret_key'); // use the real secret key here
const express = require('express');
const session = require('express-session');
const bodyParser = require('body-parser');
const sqlite3 = require('sqlite3').verbose();
const path = require('path');

const app = express();
const PORT = 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static(__dirname));
app.use(
  session({
    secret: 'raisa-secret-key',
    resave: false,
    saveUninitialized: true
  })
);

// Setup SQLite DB
const db = new sqlite3.Database('./users.db', (err) => {
  if (err) console.error('Error opening database', err);
});

db.run(
  `CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT UNIQUE,
    password TEXT
  )`
);

// Home
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'index_C231526.html'));
});

// User session check
app.get('/user', (req, res) => {
  if (req.session.user) {
    res.json({ loggedIn: true, email: req.session.user });
  } else {
    res.json({ loggedIn: false });
  }
});

// Sign up
app.post('/signup', (req, res) => {
  const { email, password } = req.body;
  db.run(`INSERT INTO users (email, password) VALUES (?, ?)`, [email, password], function (err) {
    if (err) {
      return res.send('Signup failed. User may already exist.');
    }
    req.session.user = email;
    res.redirect('/index_C231526.html');
  });
});

// Log in
app.post('/login', (req, res) => {
  const { email, password } = req.body;
  db.get(`SELECT * FROM users WHERE email = ? AND password = ?`, [email, password], (err, row) => {
    if (err || !row) {
      return res.send('Login failed. Check credentials.');
    }
    req.session.user = email;
    res.redirect('/index_C231526.html');
  });
});

// Log out
app.get('/logout', (req, res) => {
    req.session.destroy(err => {
        res.redirect('/index_C231526.html');
    });
  });

// Serve PDFs
app.get('/ebooks/:filename', (req, res) => {
  const filePath = path.join(__dirname, 'ebooks', req.params.filename);
  res.sendFile(filePath);
});

// Start server
app.listen(PORT, () => {
  console.log(`Server running at http://localhost:${PORT}`);
});

app.post('/create-checkout-session', async (req, res) => {
  const { type, id, promo } = req.body;

  let price = 500; // default price in cents (৳500)
  if (promo === 'FREE100') price = 0;

  const session = await stripe.checkout.sessions.create({
    payment_method_types: ['card'],
    line_items: [{
      price_data: {
        currency: 'bdt',
        product_data: {
          name: `${type.toUpperCase()}: ${id.replace(/-/g, ' ')}`,
        },
        unit_amount: price,
      },
      quantity: 1,
    }],
    mode: 'payment',
    success_url: 'http://localhost:3000/public/success.html',
    cancel_url: 'http://localhost:3000/public/cancel.html',
  });

  res.json({ url: session.url });
});