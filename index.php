<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Browser</title>
</head>
<style>
    * {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    table td,
    table th {
        border: 1px solid #000;
        padding: 8px;
    }

    table th:first-child {
        width: 70%;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #ddd;
    }

    table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #39408b;
        color: white;
    }
</style>

<body>
    <?php
    $dir = $_GET['dir'];

    //Check user OS and set default directory

    if (!isset($dir) || $dir === '') {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/Linux/', $agent)) $dir = '/';
        elseif (preg_match('/Win/', $agent)) $dir = 'C:/';
        elseif (preg_match('/Mac/', $agent)) $dir = '/';
    }

    print('<h2>Directory: ' . $dir . '</h2>'); // str_replace('?dir=', '', $_SERVER['REQUEST_URI'])

    $dir_items = scandir($dir);

    // Display directory items

    if (!$dir_items) {
        print '<h4>Invalid directory or you do not have permission to access it!<h4>';
    } else {
        print('<table><th>Name</th><th>Type</th><th>Actions</th>');
        foreach ($dir_items as $item) {
            if ($item != ".." and $item != ".") {
                print('<tr>');
                print('<td>' . (is_dir($dir . '/' . $item)
                    ? '<a href="'  . '?dir=' . $dir . "/" . $item . '">' . $item . '</a>'
                    : $item)
                    . '</td>');
                print('<td>' . (is_dir($dir . '/' . $item) ? "Folder" : "File") . '</td>');
                print('<td></td>');
                print('</tr>');
            }
        }
        print("</table>");
    }

    ?>
</body>

</html>