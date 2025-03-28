from sqlalchemy import create_engine, text
import sqlalchemy

class MySQLSingleton:
    _instance = None

    def __new__(cls, *args, **kwargs):
        if not cls._instance:
            cls._instance = super().__new__(cls)

            # Set MySQL credentials directly
            username = "root"
            password = "NK)9(YIN4lj.YSzg"
            host = "10.2.0.183"  # Change if needed
            database_name = "mysql"
            port = 10007  # Default MySQL port

            connection_string = f"mysql+mysqlconnector://{username}:{password}@{host}:{port}/{database_name}"

            # Create SQLAlchemy engine with pool_pre_ping enabled
            cls._instance.engine = create_engine(connection_string, pool_pre_ping=True)

        return cls._instance


# Usage example
mysql_instance = MySQLSingleton()
engine = mysql_instance.engine
print(sqlalchemy.__version__)

# List databases
try:
    with engine.connect() as connection:
        result = connection.execute(text("SHOW DATABASES"))
        databases = result.fetchall()
        print("Databases:", [db[0] for db in databases])
except Exception as e:
    print("Connection failed:", e)