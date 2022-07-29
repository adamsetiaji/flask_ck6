from flask import Flask, redirect, render_template, request, jsonify, make_response
import os
from pathlib import Path


from scriptpython.convert2csv import ToCSV
from scriptpython.importData import ImportData

app = Flask(__name__)
app.secret_key = "margodam"


@app.route('/upload', methods=['GET', 'POST'])
def upload():

    if request.method == "POST":
        filesize = request.cookies.get('filesize')
        file = request.files["file"]

        print(f"Filesize: {filesize}")
        print(file)

        res = make_response(jsonify({
            "message": f"{file.filename} uploaded"
        }))
        return res

    return render_template('public/upload.php')


app.config['UPLOAD_FOLDER'] = 'templates/file/uploads'
app.config['CSV_FOLDER'] = 'templates/file/csv'


@app.route('/upload-file', methods=['GET', 'POST'])
def upload_image():

    if request.method == "POST":
        output = request.form.to_dict()
        asal = output["asal"]

        if request.files:
            filesize = request.cookies.get('filesize')
            file = request.files['file_input']
            filename = file.filename

            # FILE DIRECTORY
            path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
            pathcsv = os.path.join(
                app.config['CSV_FOLDER'], filename.replace(".pdf", ".csv"))

            # SAVE FILES
            file.save(path)
            # CONVERT FILES
            ToCSV(path)

            # CONVERT FILES
            ImportData(asal, pathcsv)

            print(f"Filesize: {filesize}")
            print(f"Filename: {filename}")
            file_exists = Path(path)

            if file_exists.is_file():
                print(f'The file {filename} exists')
                print(f'Asal Barang : {asal}')
            else:
                print(f'The file {filename} does not exist')

            return redirect(request.url)

    return render_template('public/upload_file.php')


if __name__ == '__main__':
    app.run(debug=True)
