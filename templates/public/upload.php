<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.rtl.min.css" integrity="sha384-+4j30LffJ4tgIMrq9CwHvn0NjEvmuDCOfk6Rpg2xg7zgOxWWtLtozDEEVvBPgHqE" crossorigin="anonymous">
    <title>Upload Video</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="mb-3 mt-3">

                    <h2 class="mb-3" style="font-weight: 300">Upload File</h2>

                    <div class="form-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="form-control" id="file_input" oninput="input_filename();">
                            <label for="file_input" id="file_input_label" class="form-control d-none">Select File</label>
                        </div>
                    </div>

                    <button onclick="upload('{{request.url}}')" id="upload_btn" class="btn btn-primary">Upload</button>

                    <button class="btn btn-primary d-none" id="loading_btn" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Uploading....
                    </button>

                    <button class="btn btn-secondary d-none" id="cancel_btn" type="button">
                        <!-- <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> -->
                        Cancel Upload
                    </button>

                </div>

                <div id="progress_wrapper" class="d-none">
                    <label id="progress_status"> 50% uploaded</label>
                    <div class="progress mb-3">
                        <div id="progress" class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div id="alert_wrapper"></div>



            </div>
        </div>
    </div>


    <script>
        var progress = document.getElementById('progress')
        var progress_wrapper = document.getElementById('progress_wrapper')
        var progress_status = document.getElementById('progress_status')

        var upload_btn = document.getElementById('upload_btn')
        var loading_btn = document.getElementById('loading_btn')
        var cancel_btn = document.getElementById('cancel_btn')

        var alert_wrapper = document.getElementById('alert_wrapper')


        var input = document.getElementById('file_input')
        var file_input_label = document.getElementById('file_input_label')

        function show_alert(message, alert) {
            alert_wrapper.innerHTML = `
                <div class="alert alert-${alert} alert-dismissible fade show" role="alert">
                    <span>${message}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `
        }

        function input_filename() {
            file_input_label.innerText = input.files[0].name;
        }

        function upload(url) {

            if (!input.value) {
                show_alert("No File Selected", "warning")
                return
            }

            var data = new FormData()
            var request = new XMLHttpRequest()

            request.responseType = "json"
            alert_wrapper.innerHTML = ""

            input.disable = true

            upload_btn.classList.add("d-none")

            loading_btn.classList.remove("d-none")

            cancel_btn.classList.remove("d-none")
            progress_wrapper.classList.remove("d-none")

            var file = input.files[0]
            var filename = file.name
            var filesize = file.size

            document.cookie = `filesize=${filesize}`

            data.append("file", file)

            request.upload.addEventListener("progress", function(e) {
                var loaded = e.loaded
                var total = e.total

                var percentage_complete = (loaded / total) * 100

                progress.setAttribute("style", `width: ${Math.floor(percentage_complete)}%`)

                progress_status.innerText = `${Math.floor(percentage_complete)}% uploaded`
            })

            request.addEventListener("load", function(e) {

                if (request.status == 200) {
                    show_alert(`${request.response.message}`, "success")
                } else {
                    show_alert("Error Uploading File", "danger")
                }

                reset()
            })

            request.addEventListener("error", function(e) {
                reset()
                show_alert("Error Uploading File", "danger")

            })

            request.addEventListener("abort", function(e) {
                reset()
                show_alert("Upload Canceled", "primary")

            })

            request.open("post", url)
            request.send(data)

            cancel_btn.addEventListener("click", function() {
                request.abort()
            })


        }

        function reset() {
            input.value = null
            input.disable = false
            cancel_btn.classList.add("d-none")
            loading_btn.classList.add("d-none")
            upload_btn.classList.remove("d-none")

            progress_wrapper.classList.add("d-none")

            progress.setAttribute("style", "width: 0%")

            file_input_label.innerText = "Select File"
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>

</html>