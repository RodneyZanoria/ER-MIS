<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
            padding: 5px;
        }

        th {text-align: left;}
    </style>
</head>
<body>

<table>
        <tr>
            <th>ndex</th>
            <th>Firstname</th>
            <th>Lastname</th>
        </tr>

        <?php
            foreach($memberlist as $mem)
            {
        ?>
        <tr>
            <td><?echo $mem->ndex; ?></td>
            <td><?echo $mem->firstName; ?></td>
            <td><?echo $mem->lastName; ?></td>
        </tr>
        <?php
            }
        ?>

</table>

</body>
</html>