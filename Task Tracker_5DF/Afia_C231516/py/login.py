import oracledb
from flask import Flask, request, jsonify

# REQUIRED FOR ORACLE 10g → enable THICK mode
oracledb.init_oracle_client(lib_dir=r"D:\oracle\instantclient_23_8")  # Change this path!

app = Flask(__name__)

# Oracle connection details
dsn = oracledb.makedsn("localhost", 1521, service_name="XE")  # Change if your service name is different

@app.route('/api/login', methods=['POST'])
def login():
    data = request.get_json()
    email = data.get('email', '').strip()
    password = data.get('password', '').strip()

    # ✅ PRINT what came from the frontend
    print("Checking email from input:", repr(email))
    print("Checking password from input:", repr(password))

    if not email or not password:
        return jsonify({"success": False, "message": "Missing email or password"}), 400

    try:
        conn = oracledb.connect(user="SYSTEM", password="naifa19", dsn=dsn)
        cursor = conn.cursor()

        query = """
        SELECT * FROM users
        WHERE TRIM(LOWER(email)) = TRIM(LOWER(:email))
        AND TRIM(password) = TRIM(:password)
        """
        cursor.execute(query, {"email": email, "password": password})
        row = cursor.fetchone()

        # ✅ PRINT what the database returned
        print("Query result row:", row)

        cursor.close()
        conn.close()

        if row:
            return jsonify({"success": True})
        else:
            return jsonify({"success": False, "message": "Invalid email or password"})

    except oracledb.Error as e:
        print("Oracle error:", e)
        return jsonify({"success": False, "message": "Server error"}), 500


if __name__ == '__main__':
    app.run(debug=True, port=5001)
