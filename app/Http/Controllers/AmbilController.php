<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AmbilController extends Controller
{
    //get data
    public function index() //deklarasi fungsi index
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.thingspeak.com/channels/1567602/feeds.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            return $response;
        }
    }
    public function indexsuhu() //deklarasi index suhu (menampilkan seluruh data suhu)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/feeds.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $array_tanggal = array();
            $field1 = array();
            foreach ($response['feeds'] as $responses) {
                $array_tanggal[] = $responses['created_at'];
                $field1[] = $responses['field1'];
            }
        }

        $data['message'] = true; //menampilkan status
        $data['message'] = "Data Suhu ThingSpeak"; //menampilkan pesan
        $data['data'] = $field1;
        return $data;
    }

    public function indexsaturasi() //deklarasi index saturasi (menampilkan seluruh data satu rasi oksigen)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/feeds.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 3000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                //set here your requesred headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $array_saturasi = array();
            $field2 = array();
            foreach ($response['feeds'] as $response) {
                $array_saturasi[] = $response['field2'];
                $field2[] = $response['field2'];
            }
        }
        $data['message'] = true; //menampilkan status
        $data['message'] = "Data Saturasi Oksigen ThingSpeak"; //menampilkan pesan
        $data['data'] = $field2;
        return $data;
    }

    public function getmaxsuhu() //menampilkan suhu tertinggi
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/feeds.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 3000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                //set here your requesred headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $array_suhu = array();
            $field1 = array();
            foreach ($response['feeds'] as $response) {
                $array_suhu[] = $response['field1'];
                $field1[] = $response['field1'];
                $max = max($field1);
            }
        }
        $data['message'] = true; //menampilkan status
        $data['message'] = "Suhu Tertinggi"; //menampilkan pesan
        $data['data'] = $max;
        return $data;
    }

    public function getminsuhu() //menampilkan suhu terendah
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/feeds.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 3000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                //set here your requesred headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $array_suhu = array();
            $field1 = array();
            foreach ($response['feeds'] as $response) {
                $array_suhu[] = $response['field1'];
                $field1[] = $response['field1'];
                $min = min($field1);
            }
        }
        $data['message'] = true; //menampilkan status
        $data['message'] = "Suhu Terendah"; //menampilkan pesan
        $data['data'] = $min;
        return $data;
    }
    public function getmaxsaturasi() //menampilkan saturasi tertinggi
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/feeds.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 3000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                //set here your requesred headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $array_saturasi = array();
            $field2 = array();
            foreach ($response['feeds'] as $response) {
                $array_saturasi[] = $response['field2'];
                $field2[] = $response['field2'];
                $max = max($field2);
            }
        }
        $data['message'] = true; //menampilkan status
        $data['message'] = "Saturasi Oksigen Tertinggi"; //menampilkan pesan
        $data['data'] = $max;
        return $data;
    }

    public function getminsaturasi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/feeds.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 3000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                //set here your requesred headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $array_saturasi = array();
            $field2 = array();
            foreach ($response['feeds'] as $response) {
                $array_saturasi[] = $response['field2'];
                $field2[] = $response['field2'];
                $min = min($field2);
            }
        }
        $data['message'] = true; //menampilkan status
        $data['message'] = "Saturasi Oksigen Terendah"; //menampilkan pesan
        $data['data'] = $min;
        return $data;
    }

    public function meansuhu()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/feeds.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $array_tanggal = array();
            $field1 = array();
            foreach ($response['feeds'] as $responses) {
                $array_tanggal[] = $responses['created_at'];
                $field1[] = $responses['field1'];
                $sum = array_sum($field1);
                $count = count($field1);
                $avg = $sum / $count;
            }
        }

        $data['message'] = true; //menampilkan status
        $data['message'] = "Data Rata-Rata Suhu"; //menampilkan pesan
        $data['data'] = round($avg, 2);
        return $data;
    }

    public function meansaturasi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/feeds.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $array_tanggal = array();
            $field2 = array();
            foreach ($response['feeds'] as $responses) {
                $array_tanggal[] = $responses['created_at'];
                $field2[] = $responses['field2'];
                $sum = array_sum($field2);
                $count = count($field2);
                $avg = $sum / $count;
            }
        }

        $data['message'] = true; //menampilkan status
        $data['message'] = "Data Rata-Rata Satu Rasi Oksigen"; //menampilkan pesan
        $data['data'] = round($avg, 2);
        return $data;
    }

    public function jmlhpengunjunghariini()
    {
        $curl = curl_init();
        $currentDate = strval(gmdate("Y-m-d"));

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/fields/4.json?key=AB2MDITZZC8AK4Z9&start=" . $currentDate . "T00:00+02:00&end=" . $currentDate . "T23:59+02:00&timezone=GMT+00:00",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $field4 = array();
            foreach ($response['feeds'] as $responses) {
                $array_tanggal[] = $responses['created_at'];
                $field4[] = $responses['field4'];
                $max = max($field4);
            }
        }

        $data['message'] = true; //menampilkan status
        $data['message'] = "Data Jumlah Pengunjung Hari Ini"; //menampilkan pesan
        $data['data'] = $max; //ambil data terakhir di hari ini
        return $data;
    }

    public function jmlhpengunjungmingguini()
    {
        $curl = curl_init();
        $currentDate = strval(gmdate("Y-m-d"));
        $sevendaysago = date('Y-m-d', strtotime('-7 days'));

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/fields/4.json?key=AB2MDITZZC8AK4Z9&start=" . $sevendaysago . "T00:00+02:00&end=" . $currentDate . "T23:59+02:00&timezone=GMT+00:00",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $field4 = array();
            foreach ($response['feeds'] as $responses) {
                $array_tanggal[] = $responses['created_at'];
                $field4[] = $responses['field4'];
                $count = count($field4);
            }
        }

        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Jumlah Pengunjung Minggu Ini"; //menampilkan pesan
        $data['data'] = $count; //menampilkan jumlah data
        return $data;
    }

    public function jmlhpengunjungbulanini()
    {
        $curl = curl_init();
        $currentDate = strval(gmdate("Y-m-d"));
        $thirtydaysago = date('Y-m-d', strtotime('-30 days'));

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thingspeak.com/channels/1567602/fields/4.json?key=AB2MDITZZC8AK4Z9&start=" . $thirtydaysago . "T00:00+02:00&end=" . $currentDate . "T23:59+02:00&timezone=GMT+00:00",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

            $field4 = array();
            foreach ($response['feeds'] as $responses) {
                $array_tanggal[] = $responses['created_at'];
                $field4[] = $responses['field4'];
                $count = count($field4);
            }
        }

        $data['message'] = true; //menampilkan status
        $data['message'] = "Data Jumlah Pengunjung Minggu Ini"; //menampilkan pesan
        $data['data'] = $count; //jumlah data perbulan
        return $data;
    }
}
