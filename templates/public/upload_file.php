<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.rtl.min.css" integrity="sha384-+4j30LffJ4tgIMrq9CwHvn0NjEvmuDCOfk6Rpg2xg7zgOxWWtLtozDEEVvBPgHqE" crossorigin="anonymous">
    <title>Upload File</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="mb-3 mt-3">

                    <h2 class="mb-3" style="font-weight: 300">Upload File</h2>

                    <form action="/upload-file" method="post" enctype="multipart/form-data">

                        <div class="form-group mb-3">
                            <div class="custom-file mb-3">
                                <input type="file" class="form-control" id="file_input" name="file_input" oninput="input_filename();">
                                <label for="file_input" id="file_input_label" class="form-control d-none">Select File</label>
                            </div>
                            <div class="custom-file">
                                <label for="asal" style="font-weight: 300">Pilih Asal Barang : </label>
                                <select id="asal" name="asal" class="form-control">
                                    <option value='UD. RAJIKIN'>UD. RAJIKIN</option>
                                    <option value='PT. BULVARI PRIMA CEMERLANG (PKY)'>PT. BULVARI PRIMA CEMERLANG (PKY)</option>
                                    <option value='PT. KAHAYAN NIAGA UTAMA'>PT. KAHAYAN NIAGA UTAMA</option>
                                    <option value='PT. BINTANG ARTHA NIAGA KUSUMA'>PT. BINTANG ARTHA NIAGA KUSUMA</option>
                                    <option value='PT. CAHAYA NIAGA SEMESTA'>PT. CAHAYA NIAGA SEMESTA</option>
                                    <option value='PT.SARIMEKAR CAHAYA PERSADA'>PT.SARIMEKAR CAHAYA PERSADA</option>
                                    <option value='PT. ANTANG JAYA PERKASA'>PT. ANTANG JAYA PERKASA</option>
                                    <option value='UD. RAZIKIN'>UD. RAZIKIN</option>
                                    <option value='UD MANUHING SINAR HOKY'>UD MANUHING SINAR HOKY</option>
                                    <option value='PT. MIKOLINDO CEMERLANG PALANGKARAYA'>PT. MIKOLINDO CEMERLANG PALANGKARAYA</option>
                                    <option value='UD. TJOEN2'>UD. TJOEN2</option>
                                    <option value='PT. KLUB TIGA DELAPAN'>PT. KLUB TIGA DELAPAN</option>
                                    <option value='UD JAGAD RAYA'>UD JAGAD RAYA</option>
                                    <option value='PT. DAHA SUMBER ENERGI'>PT. DAHA SUMBER ENERGI</option>

                                </select>
                            </div>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-primary form-control importButton">Upload</button>
                        </center>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <!-- <script>
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


            request.addEventListener("load", function(e) {

                if (request.status == 302) {
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

            request.open("post", url)
            request.send(data)


        }

        function reset() {
            input.value = null
            input.disable = false

            file_input_label.innerText = "Select File"
        }
    </script> -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js" integrity="sha256-RhRrbx+dLJ7yhikmlbEyQjEaFMSutv6AzLv3m6mQ6PQ=" crossorigin="anonymous"></script>

    <!-- <script src="/assets/js/1.bundle.min.js"></script>
    <script src="/assets/js/2.min.js"></script>
    <script src="/assets/js/3.min.js"></script>
    <script src="/assets/js/4.min.js"></script>
    <script src="/assets/js/5.all.min.js"></script> -->

    <script>
        $(function() {
            $(".importButton").on("click", function() {
                Swal.fire({
                    title: "Importing",
                    html: "Please Wait",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
            });
        });
    </script>

</body>

</html>