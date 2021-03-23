<?php 
        
        //kullanıcılar tablosundan kurumu tapu olanlar çekilip kullanıcı gruplarında
        //Tapu mesaisine eklenmiştir.
        
        $n = \Carbon\Carbon::now();
        $grup = DB::table('kullanici_gruplari')->where('id',54)->get();        
        // dd($grup,$g,$g2);
        //gelen verileri stringe cast edip json string  haline gelmesini sağlıyoruz.
        $tapu = DB::table('users')->where('kurum_id', 23)->get();
        
        $js = json_encode($tapu[0]->id);

        $ids = [];
        foreach ($tapu as $key => $value) {
            array_push($ids, (string)$value->id);
        }
        $jsn= json_encode($ids);
        dd($grup);
        $update =
                     [
                          'personel_ids' => $jsn,
                          'user_id' => ROBOT_USER_ID,
                          'updated_at' => $n
                      ];
        
                      DB::table('kullanici_gruplari')->where('id', 54)->update($update);
        
        dd($jsn);


        // Burada elle müdahele ediyoruz
        //substr açıklaması $jj den sondaki , ü silmek için 0. karakterden -1 sondaki 1 kkarakteri sil anlamına geliyor.
        // ["123", "1223"]

        // $jj == '[';
        // foreach
        //     $jj .= '"'.$id.'",';

        // $jj = substr($jj, 0 ,-1);
        // $jj .= ']';


        // var_dump($js);
        dd($js);




        //genclik merkezi kullanıc
    
        $n = \Carbon\Carbon::now();
        $kontrol = DB::table('kullanici_gruplari')->where('id','53')->get();
        $data = helper('get_data_from_excel_file', '/var/www/public/genc.xlsx');
        $dataa = $data['Sayfa1']['data'];
        $ids = [];

        foreach ($dataa as $key => $value) {
            if($value['T.C']!==null){
            array_push($ids, trim((string)$value['T.C']));
            }
        }
        $personelId = [];
        $genclikUserControl = DB::table('users')->where('kurum_id', '12')->get();
        foreach($genclikUserControl as $item){
            if(in_array($item->tc,$ids)){
              array_push($personelId, trim((string)$item->id));
            }
        }
        $personelIdjs = json_encode($personelId);
            $update =
                     [
                         'personel_ids' => $personelIdjs,
                         'user_id' => ROBOT_USER_ID,
                         'updated_at' => $n
                     ];
        
                     DB::table('kullanici_gruplari')->where('id', 53)->update($update);
             


    



        dd($personelIdjs);
     
        ?>