<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Kuota_cuti_model;
use App\Models\Pegawai_model;
// EXCEL
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Kuota_cuti extends Controller
{
	// main
	public function index()
	{
		// proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
		$m_kuota_cuti 	= new Kuota_cuti_model();
		$m_pegawai 		= new Pegawai_model();

		if(isset($_GET['tahun'])) {
			$tahun 	= $_GET['tahun'];
			$nip 	= $_GET['nip'];
		}else{
			$tahun 	= date('Y');
			$nip 	= 'Semua';
		}

		$list_tahun 	= $m_kuota_cuti->list_tahun();
		$kuota_cuti 	= $m_kuota_cuti->tahun($tahun);
		$pegawai 		= $m_pegawai->listing();
		$total 			= $m_kuota_cuti->total();

		// print_r($kuota_cuti);

		$data = [   'title'     		=> 'Kuota Cuti Pegawai',
					'kuota_cuti'		=> $kuota_cuti,
					'pegawai'			=> $pegawai,
					'pegawai2'			=> $pegawai,
					'list_tahun'		=> $list_tahun,
					'content'			=> 'admin/kuota_cuti/index'
                ];
        return view('admin/layout/wrapper',$data);
	}

	// import
	public function import()
	{
		$data = [   'title'     		=> 'Import Kuota Cuti Pegawai',
					'content'			=> 'admin/kuota_cuti/import'
                ];
        return view('admin/layout/wrapper',$data);
	}

	// proses_import
	public function proses_import(Request $request)
	{
		$m_kuota_cuti = new Kuota_cuti_model();
		// proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // start import
        request()->validate([
                     'file_excel' => 'required|file|mimes:xls,xlsx,csv|max:8024',
                            ]);
        // UPLOAD START
        $image                  = $request->file('file_excel');
        $filenamewithextension  = $request->file('file_excel')->getClientOriginalName();
        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath        = './assets/upload/file';
        $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD
        $reader                 = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet            = $reader->load('./assets/upload/file/'.$input['nama_file']);
        $worksheet              = $spreadsheet->getActiveSheet();

        $i=1;
        $rows[]="";
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator   = $row->getCellIterator();
            $hasil          = $cellIterator->setIterateOnlyExistingCells(FALSE); 

            $cells = [];
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }
            $rows[] = $cells;
            if($i>3) {
                $nip  		= $rows[$i][0];
                $kuota  	= $rows[$i][2];
                $keterangan = $rows[$i][3];
                $tahun 		= $request->tahun;
                // END TANGGAL
                // check nrk
                if($nip=='') 
                {
                	// do nothing
                }else{
                	$data = [	'id_user'			=> Session()->get('id_pegawai'),
								'nip'				=> $nip,
								'tahun'				=> $tahun,
								'kuota'				=> $kuota,
								'keterangan'		=> $keterangan,
								'tanggal_post'		=> date('Y-m-d H:i:s')
							];
	                // check nip
	                $check 			= $m_kuota_cuti->tahun_nip($request->tahun,$nip);
					if($check > 0) 
					{
						DB::table('kuota_cuti')->where(['nip' 	=> $nip,
														'tahun'	=> $tahun])->update($data);
					}else{
						DB::table('kuota_cuti')->insert($data);
					}
                }
            }
            $i++;
        }
        // hapus
        unlink('./assets/upload/file/'.$input['nama_file']);
        return redirect('admin/kuota-cuti')->with(['sukses' => 'Data telah diimport']);
        // end import
	}

	// proses_tambah
	public function proses_tambah(Request $request)
	{
		
		// proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        request()->validate([
                            'nip' => 'required'
                            ]);
        $data = [	'id_user'			=> Session()->get('id_pegawai'),
					'nip'				=> $request->nip,
					'tahun'				=> $request->tahun,
					'kuota'				=> $request->kuota,
					'keterangan'		=> $request->keterangan,
					'tanggal_post'		=> date('Y-m-d H:i:s')
				];
		// check
		$m_kuota_cuti 	= new Kuota_cuti_model();
		$check 			= $m_kuota_cuti->tahun_nip($request->tahun,$request->nip);
		if($check > 0) {
			DB::table('kuota_cuti')->where(['nip' 	=> $request->nip,
											'tahun'	=> $request->tahun])->update($data);
		}else{
			DB::table('kuota_cuti')->insert($data);
		}
		// end check
        return redirect('admin/kuota-cuti')->with(['sukses' => 'Data telah ditambah']);
	}

	// edit
	public function edit($id_kuota_cuti)
	{
		$m_kuota_cuti 	= new Kuota_cuti_model();
		$m_pegawai 		= new Pegawai_model();
		$kuota_cuti 	= $m_kuota_cuti->detail($id_kuota_cuti);
		$pegawai 		= $m_pegawai->nip($kuota_cuti->nip);

		$data = [	'title'		=> 'Edit Kuota Cuti: '.$pegawai->nama_lengkap.' - Periode: '.$kuota_cuti->tahun,
					'kuota_cuti'=> $kuota_cuti,
					'pegawai'	=> $pegawai,
					'content'	=> 'admin/kuota_cuti/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses_edit
	public function proses_edit(Request $request)
	{
		
		// proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        request()->validate([
                            'nip' => 'required'
                            ]);
        $data = [	'id_kuota_cuti'		=> $request->id_kuota_cuti,
        			'id_user'			=> Session()->get('id_pegawai'),
					'nip'				=> $request->nip,
					'tahun'				=> $request->tahun,
					'kuota'				=> $request->kuota,
					'keterangan'		=> $request->keterangan,
				];
        DB::table('kuota_cuti')->where('id_kuota_cuti',$request->id_kuota_cuti)->update($data);
        return redirect('admin/kuota-cuti')->with(['sukses' => 'Data telah ditambah']);
	}

	// delete
	public function delete($id_kuota_cuti)
	{
		// proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('kuota_cuti')->where('id_kuota_cuti',$id_kuota_cuti)->delete();
        return redirect('admin/kuota-cuti')->with(['sukses' => 'Data telah dihapus']);
	}
}