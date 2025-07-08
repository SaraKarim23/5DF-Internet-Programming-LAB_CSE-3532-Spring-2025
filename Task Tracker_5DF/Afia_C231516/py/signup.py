import oracledb
from flask import Flask, request

# Initialize Oracle Instant Client
oracledb.init_oracle_client(lib_dir=r"D:\oracle\instantclient_23_8")

app = Flask(__name__)

# Oracle connection
dsn = oracledb.makedsn("localhost", 1521, service_name="XE")
connection = oracledb.connect(
    user="SYSTEM",
    password="naifa19",
    dsn=dsn
)

@app.route("/signup", methods=["POST"])
def signup():
    email = request.form.get("email")
    password = request.form.get("password")

    print(f"Received: {email}, {password}")

    try:
        with connection.cursor() as cursor:
            cursor.execute(
                "INSERT INTO users (email, password) VALUES (:1, :2)",
                (email, password)
            )
            connection.commit()
            print("Inserted successfully")
        return "Signup successful"
    except oracledb.IntegrityError:
        return "Email already exists"
    except Exception as e:
        return f"Error: {e}"

if __name__ == '__main__':
    app.run(debug=True, port=5000)

