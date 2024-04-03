<?php

// Data XML dalam string
$xml_data = <<<XML
<GetAttLogResponse>
    <Row><PIN>1</PIN><DateTime>2024-04-01 14:46:31</DateTime><Verified>15</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>1</PIN><DateTime>2024-04-01 14:54:01</DateTime><Verified>4</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>2</PIN><DateTime>2024-04-01 14:54:21</DateTime><Verified>25</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>1</PIN><DateTime>2024-04-01 14:58:27</DateTime><Verified>4</Verified><Status>1</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>1</PIN><DateTime>2024-04-01 15:24:23</DateTime><Verified>4</Verified><Status>1</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>2</PIN><DateTime>2024-04-01 15:24:47</DateTime><Verified>25</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>1</PIN><DateTime>2024-04-01 15:26:34</DateTime><Verified>15</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>1</PIN><DateTime>2024-04-02 10:23:33</DateTime><Verified>15</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>2</PIN><DateTime>2024-04-02 10:23:41</DateTime><Verified>25</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>2</PIN><DateTime>2024-04-02 10:30:01</DateTime><Verified>25</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>1</PIN><DateTime>2024-04-02 10:30:39</DateTime><Verified>15</Verified><Status>1</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>2</PIN><DateTime>2024-04-02 10:35:40</DateTime><Verified>25</Verified><Status>1</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>2</PIN><DateTime>2024-04-02 10:40:45</DateTime><Verified>25</Verified><Status>1</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>2</PIN><DateTime>2024-04-02 10:58:17</DateTime><Verified>25</Verified><Status>1</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>1</PIN><DateTime>2024-04-02 10:59:08</DateTime><Verified>15</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>4</PIN><DateTime>2024-04-02 11:43:17</DateTime><Verified>3</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
    <Row><PIN>3</PIN><DateTime>2024-04-02 11:43:19</DateTime><Verified>1</Verified><Status>0</Status><WorkCode>0</WorkCode></Row>
</GetAttLogResponse>
XML;

// Parsing XML
$xml = simplexml_load_string($xml_data);

// Membuat tabel HTML
echo "<table border='1'>";
echo "<tr><th>PIN</th><th>DateTime</th><th>Verified</th><th>Status</th><th>WorkCode</th></tr>";

// Iterasi setiap baris dan menampilkan data dalam tabel
foreach ($xml->Row as $row) {
    echo "<tr>";
    echo "<td>{$row->PIN}</td>";
    echo "<td>{$row->DateTime}</td>";
    echo "<td>{$row->Verified}</td>";
    echo "<td>{$row->Status}</td>";
    echo "<td>{$row->WorkCode}</td>";
    echo "</tr>";
}

echo "</table>";
?>
