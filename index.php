<?php 
include 'dbc.php';
function getDailyExchangeRatePBZ()
{
    $conn = OpenCon();
    $url = 'https://corp.pbz.hr/Downloads/PBZteclist.xml'; 
    $xml = new SimpleXMLElement($url, null, true);
    foreach($xml->ExchRate->Currency as $Currency) 
        {   
            /*Loop printing and converting comma to dot*/ 
            $Currency_date =  date("d.m.Y.");
            $Currency_name = $Currency -> Name;
            $Unit = str_replace(',', '.', $Currency -> Unit);
            $BuyRateForeign =  str_replace(',', '.', $Currency -> BuyRateForeign);
            $MeanRate = str_replace(',', '.', $Currency -> MeanRate);
            $SellRateForeign = str_replace(',', '.',$Currency -> SellRateForeign);
        
            $sql =  "INSERT INTO exchange_rate (BuyRateForeign,MeanRate ,SellRateForeign, Unit, Currency_name, Currency_date) VALUES 
            (".$BuyRateForeign.", ".$MeanRate.", ".$SellRateForeign.", ".$Unit.",'".$Currency_name."','".$Currency_date."')";
            $result = mysqli_query($conn,$sql);
            if(!$result)
                {
                    echo 'MySQL error';
                }
            else
                {
                    echo 'Succes';
                }   
         }       
}
//getDailyExchangeRatePBZ(); 

function getDailyExchangeRateHNB()
{
    $string_bank="HNB";
    $conn = OpenCon();
    $url = 'https://api.hnb.hr/tecajn/v1';
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);
        foreach($json_data as $key => $value)
            {
             /*Loop printing and converting comma to dot*/ 
            $Currency_date =  date("d.m.Y.");
            $Currency_name = $value["Valuta"]; 
            $BuyRateForeign =  str_replace(',', '.', $value["Kupovni za devize"]);
            $MeanRate = str_replace(',', '.', $value["Srednji za devize"]);
            $SellRateForeign = str_replace(',', '.', $value["Prodajni za devize"]);
            $Unit = str_replace(',', '.', $value["Jedinica"]);
            $sql =  "INSERT INTO exchange_rate (BuyRateForeign,MeanRate ,SellRateForeign, Unit, Currency_name, Currency_date) VALUES 
            (".$BuyRateForeign.", ".$MeanRate.", ".$SellRateForeign.", ".$Unit.",'".$Currency_name."','".$Currency_date."')";
            $result = mysqli_query($conn,$sql);
            if(!$result)
                {
                    echo 'MySQL error';
                }
             else
                {
                    echo 'Succes';
                }
            }   

}
//getDailyExchangeRateHNB();

 function save()
 {   
    $conn = OpenCon();
    $Currency_date_today =  date("d.m.Y.");
    $Currency_date_yesterday = date('d.m.Y.',strtotime("-1 days"));
    $datas = array();
    $sql = "SELECT `Unit`, `MeanRate`, `Currency_name`, `Currency_date` FROM `exchange_rate`";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0 )
    {
        while($row = mysqli_fetch_assoc($result))
            {
                $datas[]=$row;
            }   
    if (mysqli_num_rows($result)>0)
    {
        foreach($datas as $data)
        { 
            if($data['Currency_date'] == $Currency_date_today )
             {  
                $danasnji_meanRate[]=$data['MeanRate'];
             }
             if($data['Currency_date'] == $Currency_date_yesterday)
             {
                $jucerjasni_meanRate[]=$data['MeanRate'];
            
             }
        }
    } 
    for($i=0;$i<count($danasnji_meanRate);$i++)
     {    
        $danasnji_meanRate_string = round((float)$danasnji_meanRate[$i]*100);
        $jucerjasni_meanRate_string = round((float)$jucerjasni_meanRate[$i]*100);
        $datas[$i]['diff_MeanRate'] = $danasnji_meanRate_string - $jucerjasni_meanRate_string; 
      
     } 
  header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="sample.csv"');
    $fp = fopen('php://output', 'w');
    $seperator = "sep=,";
    foreach ($datas as $item) 
        {
            fputcsv($fp, $item, ';');
        }
 }
}
Save();
?> 