def ImportData(asal, path):

    import mysql.connector
    import csv
    import re
    import datetime

    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="test"
    )

    mycursor = mydb.cursor()

    # filename = "1. Januari 2020 - PT BANK.csv"
    # path = "csv/"+filename

    csv_data = csv.reader(open(path))
    header = next(csv_data)

    print("Importing data")
    for row in csv_data:
        id_ck6 = "NULL"
        asal_barang = asal
        no_ck6 = row[1]
        tgl_ck6 = datetime.datetime.strptime(
            row[2], "%d %b %Y").strftime("%Y-%m-%d")
        merk = ''.join(re.findall("(\d*\D*)@", row[3]))
        isi = ''.join(re.findall("@(\d*\D*)\sml", row[3]))
        kadar = ''.join(re.findall("kadar\s(.*)%", row[3]))
        jml_barang = row[4]
        satuan = row[5]
        jns_pengguna = row[6]
        nama_pengguna = row[7]
        jns_identitas = row[8]
        no_identitas = row[9]
        alamat = row[10]

        val = (id_ck6, asal_barang, no_ck6, tgl_ck6, merk, isi, kadar, jml_barang,
               satuan, jns_pengguna, nama_pengguna, jns_identitas, no_identitas, alamat)

        sql = "INSERT INTO ck6 (`id_ck6`, `Asal Barang`,`Nomor`,`Tanggal`,`Nama Barang`,`Isi`,`Kadar`,`Jml Barang`,`Satuan`,`Jns Pengguna`,`Nama Pengguna`,`Jns Identitas`,`No Identitas`,`Alamat`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"

        mycursor.execute(sql, val)
        mydb.commit()

    print("Import Successfuly")
    return ("Import Successfuly")
