<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">URL Shortener</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link active" aria-current="page">Welcome, <?= $user->name; ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>URL Shortener</h1>
        <input type="text" id="originalUrl" class="form-control" placeholder="Enter URL">
        <button onclick="shortenUrl()" class="btn btn-primary mt-2">Submit</button>
        <div id="shortUrlMessage" class="mt-3"></div>

        <h2 class="mt-5">URL Mapping Details</h2>
        <table id="urlMappingTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Original URL</th>
                    <th>Short URL</th>
                    <th>User ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($urlShorteners as $urlMapping) : ?>
                <tr>
                    <td><?= $urlMapping->id ?></td>
                    <td><?= $urlMapping->originalUrl ?></td>
                    <td>
                        <a href="<?= $urlMapping->originalUrl ?>"><?= $urlMapping->shortUrl ?></a>
                    </td>
                    <td><?= $urlMapping->userId ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
    function shortenUrl() {
        let originalUrl = document.getElementById("originalUrl").value;
        document.getElementById("shortUrlMessage").innerHTML = "";

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/store_url_shortener", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    let response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        let data = response.data;
                        let tableRow = document.createElement("tr");
                        tableRow.innerHTML = `<td>${data.id}</td><td>${data.originalUrl}</td><td><a href="${data.originalUrl}">${data.shortUrl}</a></td><td>${data.userId}</td>`;
                        document.getElementById("urlMappingTable").getElementsByTagName("tbody")[0].appendChild(tableRow);
                        // Clear the input field value
                        document.getElementById("originalUrl").value = "";
                    } else {
                        document.getElementById("shortUrlMessage").innerHTML = "Shortening URL failed: " + response.message;
                    }
                } else {
                    document.getElementById("shortUrlMessage").innerHTML = "Error: Unable to communicate with the server.";
                }
            }
        };
        xhr.send("originalUrl=" + originalUrl);
    }
</script>



    <!-- Bootstrap 5 JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
