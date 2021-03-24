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
    

    $conn = OpenCon();
    $sql = "SELECT `Unit`, `MeanRate`, `Currency_name`, `Currency_date` FROM `exchange_rate`";
    $result = mysqli_query($conn,$sql);
    $datas = array();
    
    if (mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $datas[]=$row; 
        }   
    }
    $Currency_date_today =  date("d.m.Y.");
    $Currency_date_yesterday = date('d.m.Y.',strtotime("-1 days"));
    $MeanRate_yesterday_array=array();
    $MeanRate_yesterday;
    $MeanRate_today_array=array();
    $MeanRate_today;
    //$Valute=array();
   // $x=array();
    if (mysqli_num_rows($result)>0)
    {
            foreach($datas as $data)
            { 
                if($data['Currency_date'] == $Currency_date_today )
                 {  
                    $Valute = $data['MeanRate'];
                    //$x = array($data['Unit'],$data['MeanRate'],$data['Currency_name'],$data['Currency_name']);
                    //array_push($Valute,$x);
                    $danasnji_meanRate[]=$data['MeanRate'];

                 }
                 if($data['Currency_date'] == $Currency_date_yesterday)
                 {
                    $MeanRate_yesterday=$data['MeanRate'];
                    $jucerjasni_meanRate[]=$data['MeanRate'];
                
                 }
            }
    }
     $danasnji_meanRate;
     $jucerjasni_meanRate;
     //$res = array();   
     $polje = array();
     for($i=0;$i<count($danasnji_meanRate);$i++)
     {    
        $res[$i] = $danasnji_meanRate[$i]-$jucerjasni_meanRate[$i]; 
        $polje[]=$res; 
        //$datas = array($Valute[$i]['Unit']);
        //array_push($rec, $array_x);
     } 
     
     print_r($polje);
     
     //echo "<pre>";
   // print_r($res);
     $datas; 
    // print_r($datas);
     $res; 
     //print_r($res);
     $resulti=array();
     $resulti = array_merge($datas, $res);
     //print_r($resulti);

    
   /* header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="sample.csv"');
    $fp = fopen('php://output', 'w');
    $seperator = "sep=,";
    foreach ($resulti as $item) 
    {
        fputcsv($fp, $item, ';');
    }*/

//Save();

     

//}
?> 