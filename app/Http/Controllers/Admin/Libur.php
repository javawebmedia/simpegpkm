<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Libur_model;
use App\Models\Jenis_libur_model;
use App\Libraries\Website;

class Libur extends Controller
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
		$m_libur 		= new Libur_model();
		$m_jenis_libur 	= new Jenis_libur_model();

		if(isset($_GET['tahun'])) {
			$tahun 	= $_GET['tahun'];
		}else{
			$tahun 	= date('Y');
		}

		$list_tahun 	= $m_libur->list_tahun();
		$libur 			= $m_libur->tahun($tahun);

		$jenis_libur 	= $m_jenis_libur->listing();
		$total 			= $m_libur->total();

		// print_r($libur);

		$data = [   'title'     		=> 'Hari dan Tanggal Libur',
					'libur'				=> $libur,
					'jenis_libur'		=> $jenis_libur,
					'list_tahun'		=> $list_tahun,
					'content'			=> 'admin/libur/index'
                ];
        return view('admin/layout/wrapper',$data);
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
                            'tanggal_libur' => 'required|unique:libur'
                            ]);
        $website 		= new Website(); 
        $tanggal_libur 	= date('Y-m-d',strtotime($request->tanggal_libur));
        $check_weekend 	= $website->get_hari($tanggal_libur);

        if($check_weekend=='Sabtu' || $check_weekend=='Minggu')
        {
        	$weekend = 'Ya';
        }else{
        	$weekend = 'Tidak';
        }

        $data = [	'id_pegawai'		=> Session()->get('id_pegawai'),
					'id_jenis_libur'	=> $request->id_jenis_libur,
					'tanggal_libur'		=> date('Y-m-d',strtotime($request->tanggal_libur)),
					'tahun'				=> date('Y',strtotime($request->tanggal_libur)),
					'status_libur'		=> $request->status_libur,
					'keterangan'		=> $request->keterangan,
					'weekend'			=> $weekend,
					'tanggal_update'	=> date('Y-m-d H:i:s')
				];
        DB::table('libur')->insert($data);
        return redirect('admin/libur')->with(['sukses' => 'Data telah ditambah']);
	}

	// weekend
	public function weekend()
	{
		$m_libur 		= new Libur_model();
		$m_jenis_libur 	= new Jenis_libur_model();
		$libur 			= $m_libur->listing();
		$jenis_libur 	= $m_jenis_libur->listing();
		$total 			= $m_libur->total();

		
		$data = [   'title'     		=> 'Setting Weekend Sebagai Hari Libur',
					'libur'				=> $libur,
					'jenis_libur'		=> $jenis_libur,
					'content'			=> 'admin/libur/weekend'
                ];
        return view('admin/layout/wrapper',$data);
	}

	// proses_weekend
	public function proses_weekend(Request $request)
	{
		// Start validasi
		request()->validate([
                            'id_jenis_libur' => 'required'
                            ]);
		// masuk database
		$year = $request->tahun;
		// Start and end dates of the year
		$startDate = new \DateTime("$year-01-01");
		$endDate = new \DateTime("$year-12-31");

		// Initialize an array to store the dates
		$saturdays = [];
		$sundays = [];

		// Loop through the dates and check the day of the week
		$currentDate = clone $startDate;
		while ($currentDate <= $endDate) {
		    if ($currentDate->format('N') == 6) { // Saturday (N=6)
		        $saturdays[] = $currentDate->format('Y-m-d');
		    } elseif ($currentDate->format('N') == 7) { // Sunday (N=7)
		        $sundays[] = $currentDate->format('Y-m-d');
		    }
		    $currentDate->modify('+1 day'); // Move to the next day
		}
		foreach($saturdays as $sabtu) {
			$data = [	'id_pegawai'		=> Session()->get('id_pegawai'),
						'id_jenis_libur'	=> $request->id_jenis_libur,
						'tanggal_libur'		=> $sabtu,
						'tahun'				=> $request->tahun,
						'status_libur'		=> $request->status_libur,
						'keterangan'		=> $request->keterangan,
						'weekend'			=> 'Ya',
						'tanggal_update'	=> date('Y-m-d H:i:s')
					];
			DB::table('libur')->insert($data);
		}
		foreach($sundays as $minggu) {
			$data = [	'id_pegawai'		=> Session()->get('id_pegawai'),
						'id_jenis_libur'	=> $request->id_jenis_libur,
						'tanggal_libur'		=> $minggu,
						'tahun'				=> $request->tahun,
						'status_libur'		=> $request->status_libur,
						'keterangan'		=> $request->keterangan,
						'weekend'			=> 'Ya',
						'tanggal_update'	=> date('Y-m-d H:i:s')
					];
			DB::table('libur')->insert($data);
		}
		// masuk database
		
        return redirect('admin/libur')->with(['sukses' => 'Data telah ditambah']);
	}

	// tahunan
	public function tahunan()
	{
		$year = $_GET['q'];
		// Start and end dates of the year
		$startDate = new \DateTime("$year-01-01");
		$endDate = new \DateTime("$year-12-31");

		// Initialize an array to store the dates
		$saturdays = [];
		$sundays = [];

		// Loop through the dates and check the day of the week
		$currentDate = clone $startDate;
		while ($currentDate <= $endDate) {
		    if ($currentDate->format('N') == 6) { // Saturday (N=6)
		        $saturdays[] = $currentDate->format('Y-m-d');
		    } elseif ($currentDate->format('N') == 7) { // Sunday (N=7)
		        $sundays[] = $currentDate->format('Y-m-d');
		    }
		    $currentDate->modify('+1 day'); // Move to the next day
		}

		// Print the dates
		echo '<div class="alert alert-light mt-1"><strong>Hari Sabtu ('.count($saturdays).' Hari):</strong><br>';
		foreach($saturdays as $sabtu) {
			echo '<span class="badge badge-success mr-1">'.date('d M Y',strtotime($sabtu)).'</span>';
		}
		echo '</div>';
		echo '<div class="alert alert-light mt-1"><strong>Hari Minggu ('.count($sundays).' Hari):</strong><br>';
		foreach($sundays as $minggu) {
			echo '<span class="badge badge-success mr-1">'.date('d M Y',strtotime($minggu)).'</span>';
		}
		echo '</div>';
	}

	// urutkan
	public function urutkan()
	{
		$m_libur = new Libur_model();
		$libur 	= $m_libur->listing();

		if(isset($_POST['page_id_array'])) 
		{
			for($i=0; $i<count($_POST["page_id_array"]); $i++)
			{
				$data = [	'id_libur'	=> $_POST["page_id_array"][$i],
							'urutan'				=> $i
						];
			 	$m_libur->edit($data);
			}
			$this->session->setFlashdata('sukses','Data telah diurutkan');
		}

		$data = [   'title'     	=> 'Urutkan Hari dan Tanggal Libur',
					'libur'	=> $libur,
					'content'		=> 'admin/libur/urutkan'
                ];
        return view('admin/layout/wrapper',$data);
    }

	// edit
	public function edit($id_libur)
	{
		$m_libur 		= new Libur_model();
		$libur 			= $m_libur->detail($id_libur);
		$m_jenis_libur 	= new Jenis_libur_model();
		$jenis_libur 	= $m_jenis_libur->listing();

		$data = [	'title'			=> 'Edit Hari dan Tanggal Libur: '.date('Y-m-d',strtotime($libur->tanggal_libur)),
					'libur'			=> $libur,
					'jenis_libur'	=> $jenis_libur,
					'content'		=> 'admin/libur/edit'
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
                            'tanggal_libur' => 'required|unique:libur'
                            ]);

        $website 		= new Website(); 
        $tanggal_libur 	= date('Y-m-d',strtotime($request->tanggal_libur));
        $check_weekend 	= $website->get_hari($tanggal_libur);

        if($check_weekend=='Sabtu' || $check_weekend=='Minggu')
        {
        	$weekend = 'Ya';
        }else{
        	$weekend = 'Tidak';
        }

        $data = [	'id_libur'			=> $request->id_libur,
        			'id_pegawai'		=> Session()->get('id_pegawai'),
					'id_jenis_libur'	=> $request->id_jenis_libur,
					'tanggal_libur'		=> date('Y-m-d',strtotime($request->tanggal_libur)),
					'tahun'				=> date('Y',strtotime($request->tanggal_libur)),
					'status_libur'		=> $request->status_libur,
					'keterangan'		=> $request->keterangan,
					'weekend'			=> $weekend,
				];
        DB::table('libur')->where('id_libur',$request->id_libur)->update($data);
        return redirect('admin/libur')->with(['sukses' => 'Data telah ditambah']);
	}

	// delete
	public function delete($id_libur)
	{
		// proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('libur')->where('id_libur',$id_libur)->delete();
        return redirect('admin/libur')->with(['sukses' => 'Data telah dihapus']);
	}
}