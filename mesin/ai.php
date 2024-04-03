<?php
// String JSON hasil dari json_encode
$json_string = '"HTTP\/1.0 200 OK\r\nServer: ZK Web Server\r\nPragma: no-cache\r\nCache-control: no-cache\r\nContent-Type: text\/xml\r\nConnection: close\r\n\r\n\r\n\r\n1<\/PIN>2024-04-01 14:46:31<\/DateTime>15<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n1<\/PIN>2024-04-01 14:54:01<\/DateTime>4<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n2<\/PIN>2024-04-01 14:54:21<\/DateTime>25<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n1<\/PIN>2024-04-01 14:58:27<\/DateTime>4<\/Verified>1<\/Status>0<\/WorkCode><\/Row>\r\n1<\/PIN>2024-04-01 15:24:23<\/DateTime>4<\/Verified>1<\/Status>0<\/WorkCode><\/Row>\r\n2<\/PIN>2024-04-01 15:24:47<\/DateTime>25<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n1<\/PIN>2024-04-01 15:26:34<\/DateTime>15<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n1<\/PIN>2024-04-02 10:23:33<\/DateTime>15<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n2<\/PIN>2024-04-02 10:23:41<\/DateTime>25<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n2<\/PIN>2024-04-02 10:30:01<\/DateTime>25<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n1<\/PIN>2024-04-02 10:30:39<\/DateTime>15<\/Verified>1<\/Status>0<\/WorkCode><\/Row>\r\n2<\/PIN>2024-04-02 10:35:40<\/DateTime>25<\/Verified>1<\/Status>0<\/WorkCode><\/Row>\r\n2<\/PIN>2024-04-02 10:40:45<\/DateTime>25<\/Verified>1<\/Status>0<\/WorkCode><\/Row>\r\n2<\/PIN>2024-04-02 10:58:17<\/DateTime>25<\/Verified>1<\/Status>0<\/WorkCode><\/Row>\r\n1<\/PIN>2024-04-02 10:59:08<\/DateTime>15<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n4<\/PIN>2024-04-02 11:43:17<\/DateTime>3<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n3<\/PIN>2024-04-02 11:43:19<\/DateTime>1<\/Verified>0<\/Status>0<\/WorkCode><\/Row>\r\n<\/GetAttLogResponse>"';

// Hapus karakter escape yang tidak diperlukan
$data_array = json_decode('['.str_replace(['\r','\n'],'',$json_string).']', true);

// Membuat tabel horizontal
echo '<table border="1" width="100%">';
echo '<tr><th>PIN</th><th>DateTime</th><th>Verified</th><th>Status</th><th>WorkCode</th></tr>';
$no=0;

foreach ($data_array as $row) {
    echo '<tr>';
    preg_match_all('/<([^>]+)>([^<]+)<\/([^>]+)>/', $row, $matches, PREG_SET_ORDER);
    for ($i = 1; $i < count($matches); $i++) {
        if($matches[$i][1]=='PIN') {
            echo '<td>'.$matches[$i][0].'</td>';
        }
        if($matches[$i][1]=='DateTime') {
            echo '<td>'.$matches[$i][0].'</td>';
        }
        if($matches[$i][1]=='Verified') {
            echo '<td>'.$matches[$i][0].'</td>';
        }
        if($matches[$i][1]=='Status') {
            echo '<td>'.$matches[$i][0].'</td>';
        }
        if($matches[$i][1]=='WorkCode') {
            echo '<td>'.$matches[$i][0].'</td>';
        }
    }
    echo '</tr>';
$no++; }

echo '</table>';
?>
