from dotenv import load_dotenv
from pathlib import Path
import mysql.connector 

env_path = (
    Path(__file__)
    .resolve()
    .parent / '.env'
)

load_dotenv(env_path)

conn_mysql = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="qlhv",
    charset="utf8",
)
