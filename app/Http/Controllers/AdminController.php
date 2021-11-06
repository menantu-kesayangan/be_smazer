<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //get admin
    public function index() //deklarasi fungsi index
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Admin"; //menampilkan pesan
        $data['data'] = Admin::all(); //mengambil semua data dari database
        return $data;
    }

    //create admin
    public function create(Request $request)
    {
        $next_id = "ADM" . date('m') . date('Y') . "0001";

        $max_pengguna = DB::table("admins")->max('kode_admin'); //ambil id terbesar > ADM10210001

        if ($max_pengguna) { //jika sudah ada generate id baru

            $pecah_dulu = str_split($max_pengguna, 10); //misal "ADM10210001" hasilnya jadi ["ADM1021", "0001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.04d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $admin = new Admin(); //inisialisasi atau menciptakan objek baru
        $admin->kode_admin = $next_id; //memanggil perintah next_id yang sudah dibuat
        $admin->nama_admin = $request->nama_admin; //menset nama_admin yang diambil dari request body
        $admin->alamat_admin = $request->alamat_admin; //menset alamat_admin yang diambil dari request body
        $admin->telepon_admin = $request->telepon_admin; //menset telepon_admin yang diambil dari request body
        $admin->email = $request->email; //menset email yang diambil dari request body
        $admin->leveluser = $request->leveluser; //menset leveluser yang diambil dari request body
        $admin->username = $request->username; //menset username yang diambil dari request body
        $admin->password = Hash::make($request->password); //menset password yang diambil dari request body

        $simpan = $admin->save(); //menyimpan data ke database
        if ($simpan) { //jika penyimpanan berhasil
            $data['status'] = true;
            $data['message'] = "Berhasil Menambahkan Admin";
            $data['data'] = $admin;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Admin";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang baru disave/simpan
    }
}
