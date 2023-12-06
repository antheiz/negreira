import mysql.connector
import json

db_config = {
    "host": "172.17.0.2",
    "user": "root",
    "password": "salupa",
    "database": "webgis_jayapura",
}


def get_db_connection():
    conn = mysql.connector.connect(**db_config)
    return conn


def execute_query(query, params=None, is_select=True):
    conn = get_db_connection()
    try:
        cur = conn.cursor()
        cur.execute(query, params)  # Parameters are passed here

        if is_select:
            result = cur.fetchall()
            cur.close()
            return result
        else:
            conn.commit()
            cur.close()
    finally:
        conn.close()


# Membuka dan membaca file JSON
with open("kelurahan.geo.json", "r") as file:
    data = json.load(file)

# Mengakses 'geometry' dan 'properties' dari feature tersebut
for feature in data["features"]:
    geometry = json.dumps(feature["geometry"])  # Convert geometry to JSON string
    properties = feature["properties"]

    # Mengakses kode_kec, nama dalam 'properties'
    kode_kd = properties["kode_kd"]
    kode_kec = properties["kode_kec"]
    nama = properties["nama"]

    # Membuat query INSERT
    query = """
    INSERT INTO kelurahan (id, kecamatan_id, nama_kelurahan, peta_kelurahan, created_at)
    VALUES
    (%s, %s, %s, ST_GeomFromGeoJSON(%s), NOW())
    """

    # Parameter untuk query
    params = (kode_kd, kode_kec, nama, geometry)

    # Jalankan query INSERT
    execute_query(query, params, is_select=False)
