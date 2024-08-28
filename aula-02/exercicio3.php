<style>
    table {
        border-collapse: collapse;
        border: none;
    }
    th {
        border-left: none;
        border-right: none;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }
    tr:last-child {
        border-left: none;
        border-right: none;
        border-top: none;
        border-bottom: 1px solid black;
    }
    td {
        border:none;
    }
    th, td {
        text-align: right;
        padding: 6px;
    }
</style>
<table border="1">
    <thead>
        <th>Tempo</th>
        <th>Montante</th>
        <th>Juro</th>
    </thead>
    <tbody>
        <?php
        $capital = $_GET['capital'];
        $taxa = $_GET['taxa'];
        $tempo = $_GET['tempo'];
        
        for($i = 0; $i <= $tempo; $i++):
            $juro = $capital * ($taxa/100) * $i;
            $montante = $capital + $juro;
        ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $montante ?></td>
            <td><?= $juro ?></td>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>