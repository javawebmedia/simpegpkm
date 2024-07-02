<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Jenis_dokumen_model;
use App\Models\Sub_jenis_dokumen_model;
use Image;

class Jenis_dokumen extends Controller
{
    // Index
    public function index()
    {
    	if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
        $m_sub_jenis_dokumen    = new Sub_jenis_dokumen_model();
		$jenis_dokumen 	      = DB::table('jenis_dokumen')->orderBy('id_jenis_dokumen','DESC')->get();
        $akhir                  = DB::table('jenis_dokumen')->orderBy('urutan','DESC')->first();
        if($akhir) {
            $urutan = $akhir->urutan+1;
        }else{
            $urutan = 1;
        }

        $data = array(    'title'               => 'Jenis Dokumen Pegawai ('.count($jenis_dokumen).')',
                          'jenis_dokumen'       => $jenis_dokumen,
                          'urutan'              => $urutan,
                          'm_sub_jenis_dokumen' => $m_sub_jenis_dokumen,
                          'content'             => 'admin/jenis_dokumen/index'
                      );
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_jenis_dokumen)
    {
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
        $jenis_dokumen   = DB::table('jenis_dokumen')->where('id_jenis_dokumen',$id_jenis_dokumen)->orderBy('id_jenis_dokumen','DESC')->first();

        $data = array(  'title'         => 'Edit Jenis Dokumen Pegawai',
                        'jenis_dokumen'    => $jenis_dokumen,
                        'content'       => 'admin/jenis_dokumen/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // sub
    public function sub($id_jenis_dokumen)
    {
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
        $jenis_dokumen      = DB::table('jenis_dokumen')->where('id_jenis_dokumen',$id_jenis_dokumen)->orderBy('id_jenis_dokumen','DESC')->first();
        $sub_jenis_dokumen   = DB::table('sub_jenis_dokumen')->where('id_jenis_dokumen',$id_jenis_dokumen)->orderBy('urutan','ASC')->get();
        $sub_jenis_dokumen_akhir   = DB::table('sub_jenis_dokumen')->where('id_jenis_dokumen',$id_jenis_dokumen)->orderBy('urutan','DESC')->first();

        if($sub_jenis_dokumen_akhir) {
            $urutan     = $sub_jenis_dokumen_akhir->urutan+1;
        }else{
            $urutan     = 1;
        }

        $data = array(  'title'             => 'Sub Jenis Dokumen: '.$jenis_dokumen->nama_jenis_dokumen,
                        'jenis_dokumen'     => $jenis_dokumen,
                        'urutan'            => $urutan,
                        'sub_jenis_dokumen' => $sub_jenis_dokumen,
                        'content'           => 'admin/jenis_dokumen/sub'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        //website('user_log');
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_jenis_dokumennya       = $request->id_jenis_dokumen;
            for($i=0; $i < sizeof($id_jenis_dokumennya);$i++) {
                DB::table('jenis_dokumen')->where('id_jenis_dokumen',$id_jenis_dokumennya[$i])->delete();
            }
            return redirect('admin/jenis-dokumen')->with(['sukses' => 'Data telah dihapus']);
        // PROSES SETTING DRAFT
        }
    }

    // tambah
    public function tambah(Request $request)
    {
    	if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
    	request()->validate([
                            'nama_jenis_dokumen'  => 'required|unique:jenis_dokumen',
					        'kode_jenis_dokumen'  => 'required|unique:jenis_dokumen',
                            'gambar'           => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,zip,rar|max:8024',
					        ]);
        // UPLOAD START
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_jenis_dokumen_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = './assets/upload/jenis_dokumen/';
            $image->move($destinationPath, $input['nama_jenis_dokumen_file']);
            // END UPLOAD
            DB::table('jenis_dokumen')->insert([
                'id_pegawai'               => Session()->get('id_pegawai'),
                'kode_jenis_dokumen'      => $request->kode_jenis_dokumen,
                'nama_jenis_dokumen'      => $request->nama_jenis_dokumen,
                'keterangan'   	        => $request->keterangan,
                'kode_template'         => $request->kode_template,
                'status_jenis_dokumen'    => $request->status_jenis_dokumen,
                'urutan'                => $request->urutan,
                'gambar'                => $input['nama_jenis_dokumen_file']      
            ]);
        }else{
             DB::table('jenis_dokumen')->insert([
                'id_pegawai'               => Session()->get('id_pegawai'),
                'kode_jenis_dokumen'      => $request->kode_jenis_dokumen,
                'nama_jenis_dokumen'      => $request->nama_jenis_dokumen,
                'keterangan'            => $request->keterangan,
                'kode_template'         => $request->kode_template,
                'status_jenis_dokumen'    => $request->status_jenis_dokumen,
                'urutan'                => $request->urutan,
                // 'gambar'                => $input['nama_jenis_dokumen_file']      
            ]);
        }
        return redirect('admin/jenis-dokumen')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit
    public function proses_edit(Request $request)
    {
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
        request()->validate([
                            'nama_jenis_dokumen' => 'required',
                            'kode_jenis_dokumen' => 'required',
                            'gambar'           => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,zip,rar|max:8024',
                            ]);
        // UPLOAD START
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            // UPLOAD START
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_jenis_dokumen_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = './assets/upload/jenis_dokumen/';
            $image->move($destinationPath, $input['nama_jenis_dokumen_file']);
            // END UPLOAD
            $slug_user = Str::slug($request->nama_jenis_dokumen, '-');
            DB::table('jenis_dokumen')->where('id_jenis_dokumen',$request->id_jenis_dokumen)->update([
                'id_pegawai'                => Session()->get('id_pegawai'),
                'kode_jenis_dokumen'      => $request->kode_jenis_dokumen,
                'nama_jenis_dokumen'      => $request->nama_jenis_dokumen,
                'keterangan'            => $request->keterangan,
                'kode_template'         => $request->kode_template,
                'status_jenis_dokumen'    => $request->status_jenis_dokumen,
                'urutan'                => $request->urutan,
                'gambar'                => $input['nama_jenis_dokumen_file']      
            ]);
        }else{
            $slug_user = Str::slug($request->nama_jenis_dokumen, '-');
            DB::table('jenis_dokumen')->where('id_jenis_dokumen',$request->id_jenis_dokumen)->update([
                'id_pegawai'               => Session()->get('id_pegawai'),
                'kode_jenis_dokumen'      => $request->kode_jenis_dokumen,
                'nama_jenis_dokumen'      => $request->nama_jenis_dokumen,
                'keterangan'            => $request->keterangan,
                'kode_template'         => $request->kode_template,
                'status_jenis_dokumen'    => $request->status_jenis_dokumen,
                'urutan'                => $request->urutan,
                // 'gambar'                => $input['nama_jenis_dokumen_file']      
            ]);
        }
        return redirect('admin/jenis-dokumen')->with(['sukses' => 'Data telah diupdate']);
    }

     // tambah
    public function tambah_sub(Request $request)
    {
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
        request()->validate([
                            'nama_sub_jenis_dokumen'  => 'required|unique:sub_jenis_dokumen',
                            'kode_sub_jenis_dokumen'  => 'required|unique:sub_jenis_dokumen',
                            'gambar'           => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,zip,rar|max:8024',
                            ]);
        // UPLOAD START
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_sub_jenis_dokumen_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = './assets/upload/sub_jenis_dokumen/';
            $image->move($destinationPath, $input['nama_sub_jenis_dokumen_file']);
            // END UPLOAD
            DB::table('sub_jenis_dokumen')->insert([
                'id_pegawai'                    => Session()->get('id_pegawai'),
                'id_jenis_dokumen'              => $request->id_jenis_dokumen,
                'kode_sub_jenis_dokumen'      => $request->kode_sub_jenis_dokumen,
                'nama_sub_jenis_dokumen'      => $request->nama_sub_jenis_dokumen,
                'keterangan'            => $request->keterangan,
                'kode_template'         => $request->kode_template,
                'status_sub_jenis_dokumen'    => $request->status_sub_jenis_dokumen,
                'urutan'                => $request->urutan,
                'gambar'                => $input['nama_sub_jenis_dokumen_file']      
            ]);
        }else{
             DB::table('sub_jenis_dokumen')->insert([
                'id_pegawai'               => Session()->get('id_pegawai'),
                'id_jenis_dokumen'              => $request->id_jenis_dokumen,
                'kode_sub_jenis_dokumen'      => $request->kode_sub_jenis_dokumen,
                'nama_sub_jenis_dokumen'      => $request->nama_sub_jenis_dokumen,
                'keterangan'            => $request->keterangan,
                'kode_template'         => $request->kode_template,
                'status_sub_jenis_dokumen'    => $request->status_sub_jenis_dokumen,
                'urutan'                => $request->urutan,
                // 'gambar'                => $input['nama_sub_jenis_dokumen_file']      
            ]);
        }
        return redirect('admin/jenis-dokumen/sub/'.$request->id_jenis_dokumen)->with(['sukses' => 'Data telah ditambah']);
    }

    // edit
    public function edit_sub(Request $request)
    {
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
        request()->validate([
                            'nama_sub_jenis_dokumen' => 'required',
                            'kode_sub_jenis_dokumen' => 'required',
                            'gambar'           => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,zip,rar|max:8024',
                            ]);
        // UPLOAD START
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            // UPLOAD START
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_jenis_dokumen_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = './assets/upload/jenis_dokumen/';
            $image->move($destinationPath, $input['nama_jenis_dokumen_file']);
            // END UPLOAD
            $slug_user = Str::slug($request->nama_jenis_dokumen, '-');
            DB::table('jenis_dokumen')->where('id_sub_jenis_dokumen',$request->id_sub_jenis_dokumen)->update([
                'id_pegawai'                    => Session()->get('id_pegawai'),
                'id_jenis_dokumen'              => $request->id_jenis_dokumen,
                'kode_sub_jenis_dokumen'      => $request->kode_sub_jenis_dokumen,
                'nama_sub_jenis_dokumen'      => $request->nama_sub_jenis_dokumen,
                'keterangan'            => $request->keterangan,
                'kode_template'         => $request->kode_template,
                'status_sub_jenis_dokumen'    => $request->status_sub_jenis_dokumen,
                'urutan'                => $request->urutan,
                'gambar'                => $input['nama_sub_jenis_dokumen_file']    
            ]);
        }else{
            $slug_user = Str::slug($request->nama_jenis_dokumen, '-');
            DB::table('sub_jenis_dokumen')->where('id_sub_jenis_dokumen',$request->id_sub_jenis_dokumen)->update([
                'id_pegawai'                    => Session()->get('id_pegawai'),
                'id_jenis_dokumen'              => $request->id_jenis_dokumen,
                'kode_sub_jenis_dokumen'      => $request->kode_sub_jenis_dokumen,
                'nama_sub_jenis_dokumen'      => $request->nama_sub_jenis_dokumen,
                'keterangan'            => $request->keterangan,
                'kode_template'         => $request->kode_template,
                'status_sub_jenis_dokumen'    => $request->status_sub_jenis_dokumen,
                'urutan'                => $request->urutan,
            ]);
        }
        return redirect('admin/jenis-dokumen/sub/'.$request->id_jenis_dokumen)->with(['sukses' => 'Data telah ditambah']);
    }
    

    // activate
    public function activate($id_jenis_dokumen)
    {
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
        $jenis_dokumen   = DB::table('jenis_dokumen')->where('id_jenis_dokumen',$id_jenis_dokumen)->orderBy('id_jenis_dokumen','DESC')->first();
        if($_GET['status']=='Disable') {
            $status_jenis_dokumen    = 'Non Aktif';
        }elseif($_GET['status']=='Activate') {
            $status_jenis_dokumen    = 'Aktif';
        }
        DB::table('jenis_dokumen')->where('id_jenis_dokumen',$id_jenis_dokumen)->update([
                'updated_by'            => Session()->get('id_pegawai'),
                'status_jenis_dokumen'     => $status_jenis_dokumen
            ]);
        return redirect('admin/jenis-dokumen')->with(['sukses' => 'Data status unit kerja: '.$jenis_dokumen->nama_jenis_dokumen.' telah diupdate']);
    }

    // Delete
    public function delete_sub($id_jenis_dokumen,$id_sub_jenis_dokumen)
    {
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
        DB::table('sub_jenis_dokumen')->where('id_sub_jenis_dokumen',$id_sub_jenis_dokumen)->delete();
        return redirect('admin/jenis-dokumen/sub/'.$id_jenis_dokumen)->with(['sukses' => 'Data telah dihapus']);
    }

    // Delete
    public function delete($id_jenis_dokumen)
    {
    	if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
    	DB::table('jenis_dokumen')->where('id_jenis_dokumen',$id_jenis_dokumen)->delete();
    	return redirect('admin/jenis-dokumen')->with(['sukses' => 'Data telah dihapus']);
    }
}
