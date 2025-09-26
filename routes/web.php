<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    SejarahController, VisiMisiTujuanController, DashboardController,
    ProfilPimpinanController, ProfilStaffDosenController,PanduanPendidikanController,
    ProgramStudiController, FasilitasController, AkreditasiController,
    KalenderAkademikController, AgendaController, BeasiswaController, InformasiController,
    PrestasiMahasiswaController,PengumumanController, YudisiumWisudaController,
    PendaftaranController, TentangAlumniController, IkatanAlumniController,
    TracerStudyController, PeluangKerjaController, OrmawaController,
    PaktaIntegritasController, AturanGratifikasiController, DokumenZonaIntegritasController,
    UnibaMaduraExpoController, SOPController,

};
use App\Http\Controllers\{
    ProfilController, HomeController, AkademikController, KemahasiswaanController, BeritaController, InformasiPublikController, AlumniController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/home');
Route::get('/home',                                                [HomeController::class, 'index'])->name('home');

// PROFIL
Route::get('/profil/sejarah-fik/',                                 [ProfilController::class, 'sejarah'])->name('guest.sejarah');
Route::get('/profil/visi-misi-tujuan-fik/',                        [ProfilController::class, 'visiMisiTujuanFeb'])->name('guest.visi-misi');
Route::get('/profil/pimpinan-fik/',                                [ProfilController::class, 'pimpinanFeb'])->name('guest.pimpinan');
Route::get('/profil/staff-dosen-fik/',                             [ProfilController::class, 'staffDosenFeb'])->name('guest.staff-dosen-fik');
Route::get('/profil/rencana-strategis-fik/',                       [ProfilController::class, 'rencanaStrategis'])->name('guest.rencana-strategis-fik');
Route::get('/profil/fasilitas-fik/',                               [ProfilController::class, 'fasilitas'])->name('guest.fasilitas-fik');
Route::get('/profil/akreditasi-fik/',                              [ProfilController::class, 'akreditasi'])->name('guest.akreditasi-fik');
// Route::get('/profil/struktur-organisasi-fik/',                  [ProfilController::class, 'strukturOrganisasi'])->name('guest.struktur-organisasi-fik');

// AKADEMIK
Route::get('/akademik/panduan-pendidikan-fik/',                    [AkademikController::class, 'panduanPendidikanFeb'])->name('guest.panduan-pendidikan-fik');
Route::get('/akademik/buku-pedoman-skripsi-fik/',                  [AkademikController::class, 'bukuPedomanSkripsiFeb'])->name('guest.buku-pedoman-skripsi-fik');
Route::get('/akademik/program-studi-fik/manajemen',                [AkademikController::class, 'manajemen'])->name('guest.manajemen-fik');
Route::get('/akademik/program-studi-fik/akuntansi',                [AkademikController::class, 'akuntansi'])->name('guest.akuntansi-fik');
Route::get('/akademik/program-studi-fik/teknik-industri',          [AkademikController::class, 'teknikIndustri'])->name('guest.teknik-industri-fik');
Route::get('/akademik/kalender-akademik-fik/',                     [AkademikController::class, 'kalenderAkademikFeb'])->name('guest.kalender-akademik-fik');
Route::get('/akademik/yudisium-dan-wisuda/',                       [AkademikController::class, 'yudisiumDanWisuda'])->name('guest.yudisium-dan-wisuda-fik');

// KEMAHASISWAAN
Route::get('/kemahasiswaan/info-kemahasiswaan/beasiswa',           [KemahasiswaanController::class, 'beasiswa'])->name('guest.beasiswa-fik');
Route::resource('info-kemahasiswaan-beasiswa',                     KemahasiswaanController::class);
Route::get('/kemahasiswaan/info-kemahasiswaan/prestasi-mahasiswa', [KemahasiswaanController::class, 'prestasiMahasiswa'])->name('guest.prestasi-mahasiswa-fik');
Route::resource('info-kemahasiswaan/prestasi-mahasiswa',           KemahasiswaanController::class);
Route::resource('info-kemahasiswaan/ormawa-fik',                   KemahasiswaanController::class);

// BERITA
Route::get('/berita/informasi-fik',                                [BeritaController::class, 'informasi'])->name('guest.informasi-fik');
Route::resource('berita-informasi-fik',                            BeritaController::class);
Route::resource('berita-pengumuman-fik',                           BeritaController::class);
Route::get('/berita/pengumuman-fik',                               [BeritaController::class, 'pengumuman'])->name('guest.pengumuman-fik');
Route::get('/berita/agenda-fik',                                   [BeritaController::class, 'agenda'])->name('guest.agenda-fik');

// ALUMNI
Route::get('/alumni/tentang-alumni-fik',                           [AlumniController::class, 'tentang'])->name('guest.tentang-alumni-fik');
Route::resource('alumni-tentang-alumni-fik',                       AlumniController::class);
Route::get('/alumni/ikatan-alumni-fik',                            [AlumniController::class, 'ikatan'])->name('guest.ikatan-alumni-fik');
Route::resource('peluang-kerja-fik',                               AlumniController::class);
Route::get('/alumni/peluang-kerja-fik',                            [AlumniController::class, 'peluang'])->name('guest.peluang-kerja-fik');

// INFORMASI PUBLIK
Route::get('/alumni/zona-integritas/pakta-integritas-fik',         [InformasiPublikController::class,  'pakta'])->name('guest.pakta-integritas-fik');
Route::get('/alumni/zona-integritas/aturan-gratifikasi-fik',       [InformasiPublikController::class,  'aturan'])->name('guest.aturan-gratifikasi-fik');
Route::get('/alumni/zona-integritas/dokumen-zona-integritas-fik',  [InformasiPublikController::class,  'dokumen'])->name('guest.dokumen-zona-integritas-fik');
Route::get('/alumni/zona-integritas/uniba-expo-fik',               [InformasiPublikController::class,  'expo'])->name('guest.dokumen-zona-integritas-fik');
Route::get('/alumni/zona-integritas/sop-fik',                      [InformasiPublikController::class,  'sop'])->name('guest.dokumen-zona-integritas-fik');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // HOME
    Route::get('/dashboard',                                                                [DashboardController::class, 'index'])->name('dashboard');

    // PROFIL
    Route::get('Akreditasi-fik',                                                            [AkreditasiController::class,                  'show'])    ->name('akreditasi-fik.show');
    Route::post('admin/profil/akreditasi-fik/header',                                       [AkreditasiController::class,                  'header'])  ->name('akreditasi-fik.header');
    Route::resource('admin/profil/akreditasi-fik',                                          AkreditasiController::class)        ->except(['show']);

    Route::get('fasilitas-fik',                                                             [FasilitasController::class,                  'show'])    ->name('fasilitas-fik.show');
    Route::post('admin/profil/fasilitas-fik/header',                                        [FasilitasController::class,                  'header'])  ->name('fasilitas-fik.header');
    Route::resource('admin/profil/fasilitas-fik',                                           FasilitasController::class)        ->except(['show']);

    Route::get('sejarah-fik',                                                               [SejarahController::class,                  'show'])    ->name('sejarah-fik.show');
    Route::post('admin/profil/sejarah-fik/header',                                          [SejarahController::class,                  'header'])  ->name('sejarah-fik.header');
    Route::resource('admin/profil/sejarah-fik',                                             SejarahController::class)        ->except(['show']);

    Route::get('visi-misi-tujuan-fik',                                                      [VisiMisiTujuanController::class,           'show'])    ->name('visi-misi-tujuan-fik.show');
    Route::post('admin/profil/visi-misi-tujuan-fik/header',                                 [VisiMisiTujuanController::class,           'header'])  ->name('visi-misi-tujuan-fik.header');
    Route::resource('admin/profil/visi-misi-tujuan-fik',                                    VisiMisiTujuanController::class) ->except(['show']);

    Route::get('pimpinan-fik',                                                              [ProfilPimpinanController::class,           'show'])    ->name('pimpinan-fik.show');
    Route::post('admin/profil/pimpinan-fik/header',                                         [ProfilPimpinanController::class,           'header'])  ->name('pimpinan-fik.header');
    Route::resource('admin/profil/pimpinan-fik',                                            ProfilPimpinanController::class) ->except(['show']);

    Route::get('staff-dosen-fik',                                                           [ProfilStaffDosenController::class,         'show'])    ->name('staff-dosen-fik.show');
    Route::post('admin/profil/staff-dosen-fik/header',                                      [ProfilStaffDosenController::class,         'header'])  ->name('staff-dosen-fik.header');
    Route::resource('admin/profil/staff-dosen-fik',                                         ProfilStaffDosenController::class)->except(['show']);

    // Route::post('admin/profil/identitas-fik/header',                                      [IdentitasFSTController::class,             'header']) ->name('identitas-fik.header');
    // Route::get('identitas-fik',                                                           [IdentitasFSTController::class,             'show'])   ->name('identitas-fik.show');
    // Route::resource('admin/profil/identitas-fik',                                         IdentitasFSTController::class)    ->except(['show']);

    // AKADEMIK
    Route::get('panduan-pendidikan-fik',                                                    [PanduanPendidikanController::class,            'show'])            ->name('panduan-pendidikan-fik.show');
    Route::post('admin/akademik/panduan-pendidikan-fik/header',                             [PanduanPendidikanController::class,            'header'])          ->name('panduan-pendidikan-fik.header');
    Route::resource('admin/akademik/panduan-pendidikan-fik',                                PanduanPendidikanController::class)   ->except(['show']);

    Route::post('admin/akademik/program-studi-fik/header',                                  [ProgramStudiController::class,             'header'])          ->name('program-studi-fik.header');
    Route::resource('admin/akademik/program-studi-fik',                                     ProgramStudiController::class);
    Route::post('admin/akademik/program-studi-fik/{id?}/create',                            [ProgramStudiController::class,             'detailStore']) ->name('program-studi-fik.detail.store');
    Route::post('admin/akademik/program-studi-fik/{id?}/update',                            [ProgramStudiController::class,             'detailUpdate']) ->name('program-studi-fik.detail.update');
    Route::post('admin/akademik/program-studi-fik/{id?}/edit',                              [ProgramStudiController::class,               'detailEdit']) ->name('program-studi-fik.detail.edit');
    Route::delete('admin/akademik/program-studi-fik/{id?}/delete',                          [ProgramStudiController::class,               'detailDestroy']) ->name('program-studi-fik.detail.destroy');

    Route::get('kalender-akademik-fik',                                                     [KalenderAkademikController::class,            'show'])            ->name('kalender-akademik-fik.show');
    Route::post('admin/akademik/kalender-akademik-fik/header',                              [KalenderAkademikController::class,            'header'])          ->name('kalender-akademik-fik.header');
    Route::resource('admin/akademik/kalender-akademik-fik',                                 KalenderAkademikController::class)   ->except(['show']);

    Route::get('yudisium-wisuda-fik',                                                       [YudisiumWisudaController::class,            'show'])            ->name('yudisium-wisuda-fik.show');
    Route::post('admin/akademik/yudisium-wisuda-fik/header',                                [YudisiumWisudaController::class,            'header'])          ->name('yudisium-wisuda-fik.header');
    Route::resource('admin/akademik/yudisium-wisuda-fik',                                   YudisiumWisudaController::class)   ->except(['show']);

    Route::resource('admin/akademik/pendaftaran-fik',                                       PendaftaranController::class)   ->except(['show']);

    // KEMAHASISWAAN
    Route::resource('admin/kemahasiswaan/info-kemahasiswaan/beasiswa-fik',                  BeasiswaController::class)   ->except(['show']);
    Route::get('beasiswa-fik',                                                              [BeasiswaController::class,            'show'])            ->name('beasiswa-fik.show');
    Route::post('admin/kemahasiswaan/info-kemahasiswaan/beasiswa-fik/header',               [BeasiswaController::class,            'header'])          ->name('beasiswa-fik.header');

    Route::resource('admin/kemahasiswaan/info-kemahasiswaan/prestasi-mahasiswa-fik',        PrestasiMahasiswaController::class)   ->except(['show']);
    Route::get('prestasi-mahasiswa-fik',                                                    [PrestasiMahasiswaController::class,            'show'])            ->name('prestasi-mahasiswa-fik.show');
    Route::post('admin/kemahasiswaan/info-kemahasiswaan/prestasi-mahasiswa-fik/header',     [PrestasiMahasiswaController::class,            'header'])          ->name('prestasi-mahasiswa-fik.header');

    Route::resource('admin/kemahasiswaan/ormawa-fik',                                      OrmawaController::class)   ->except(['show']);
    Route::post('admin/kemahasiswaan/ormawa/BEM-fik/header',                                [OrmawaController::class,            'header'])          ->name('ormawa-fik.header');

    // BERITA
    Route::resource('admin/berita/informasi-fik',                                           InformasiController::class)   ->except(['show']);
    Route::get('informasi-fik',                                                             [InformasiController::class,            'show'])            ->name('informasi-fik.show');
    Route::post('admin/berita/informasi-fik/header',                                        [InformasiController::class,            'header'])          ->name('informasi-fik.header');

    Route::resource('admin/berita/pengumuman-fik',                                          PengumumanController::class)   ->except(['show']);
    Route::get('pengumuman-fik',                                                            [PengumumanController::class,            'show'])            ->name('pengumuman-fik.show');
    Route::post('admin/berita/pengumuman-fik/header',                                       [PengumumanController::class,            'header'])          ->name('pengumuman-fik.header');

    Route::resource('admin/berita/agenda-fik',                                              AgendaController::class)   ->except(['show']);
    Route::get('agenda-fik',                                                                [AgendaController::class,            'show'])            ->name('agenda-fik.show');
    Route::post('admin/berita/agenda-fik/header',                                           [AgendaController::class,            'header'])          ->name('agenda-fik.header');

    // ALUMNI
    Route::resource('admin/alumni/tentang-alumni-fik',                                      TentangAlumniController::class)   ->except(['show']);
    Route::get('tentang-alumni-fik',                                                        [TentangAlumniController::class,            'show'])            ->name('tentang-alumni-fik.show');
    Route::post('admin/alumni/tentang-alumni-fik/header',                                   [TentangAlumniController::class,            'header'])          ->name('tentang-alumni-fik.header');

    Route::resource('admin/alumni/ikatan-alumni-fik',                                       IkatanAlumniController::class)   ->except(['show']);
    Route::get('ikatan-alumni-fik',                                                         [IkatanAlumniController::class,            'show'])            ->name('ikatan-alumni-fik.show');
    Route::post('admin/alumni/ikatan-alumni-fik/header',                                    [IkatanAlumniController::class,            'header'])          ->name('ikatan-alumni-fik.header');

    Route::resource('admin/alumni/tracer-study-fik',                                        TracerStudyController::class)   ->except(['show']);

    Route::resource('admin/alumni/peluang-kerja-fik',                                       PeluangKerjaController::class)   ->except(['show']);
    Route::get('peluang-kerja-fik',                                                         [PeluangKerjaController::class,            'show'])            ->name('peluang-kerja-fik.show');
    Route::post('admin/alumni/peluang-kerja-fik/header',                                    [PeluangKerjaController::class,            'header'])          ->name('peluang-kerja-fik.header');

    // INFORMASI PUBLIK
    Route::resource('admin/informasi-publik/zona-integritas/pakta-integritas-fik',          PaktaIntegritasController::class)   ->except(['show']);
    Route::get('pakta-integritas-fik',                                                      [PaktaIntegritasController::class,            'show'])            ->name('pakta-integritas-fik.show');
    Route::post('admin/informasi-publik/zona-integritas/pakta-integritas-fik/header',       [PaktaIntegritasController::class,            'header'])          ->name('pakta-integritas-fik.header');

    Route::resource('admin/informasi-publik/zona-integritas/aturan-gratifikasi-fik',        AturanGratifikasiController::class)   ->except(['show']);
    Route::get('aturan-gratifikasi-fik',                                                    [AturanGratifikasiController::class,            'show'])            ->name('aturan-gratifikasi-fik.show');
    Route::post('admin/informasi-publik/zona-integritas/aturan-gratifikasi-fik/header',     [AturanGratifikasiController::class,            'header'])          ->name('aturan-gratifikasi-fik.header');

    Route::resource('admin/informasi-publik/zona-integritas/dokumen-zona-integritas-fik',   DokumenZonaIntegritasController::class)   ->except(['show']);
    Route::get('dokumen-zona-integritas-fik',                                               [DokumenZonaIntegritasController::class,            'show'])            ->name('dokumen-zona-integritas-fik.show');
    Route::post('admin/informasi-publik/zona-integritas/dokumen-zona-integritas-fik/header',[DokumenZonaIntegritasController::class,            'header'])          ->name('dokumen-zona-integritas-fik.header');


    Route::resource('admin/informasi-publik/download-dokumen/uniba-madura-expo-fik',               UnibaMaduraExpoController::class)   ->except(['show']);
    Route::get('uniba-madura-expo-fik',                                                     [UnibaMaduraExpoController::class,            'show'])            ->name('uniba-madura-expo-fik.show');
    Route::post('admin/informasi-publik/download-dokumen/uniba-madura-expo-fik/header',     [UnibaMaduraExpoController::class,            'header'])          ->name('uniba-madura-expo-fik.header');

    Route::resource('admin/informasi-publik/download-dokumen/sop-fik',                      SOPController::class)   ->except(['show']);
    Route::get('sop-fik',                                                                   [SOPController::class,            'show'])            ->name('sop-fik.show');
    Route::post('admin/informasi-publik/download-dokumen/sop-fik/header',                   [SOPController::class,            'header'])          ->name('sop-fik.header');



});
// profil
// Route::get('profil/visi-misi-tujuan-fik',           [ProfilController::class, 'visiMisiIndex']);            //index
// Route::get('profil/staff-dosen',                    [ProfilController::class, 'staffDosenIndex']);          //index
// Route::get('profil/tenaga-kependidikan',            [ProfilController::class, 'tendikIndex']);              //index
// Route::get('profil/pimpinan-fakultas',              [ProfilController::class, 'pimFakIndex']);              //index
// Route::get('profil/identitas-fik',                  [ProfilController::class, 'identitasIndex']);           //index
// Route::get('profil/struktur-organisasi',            [ProfilController::class, 'strukOrgIndex']);            //index

// // akademik
// Route::get('akademik/panduan-pendidikan-fik',       [AkademikController::class, 'panPendikIndex']);         //index
// Route::get('akademik/program-studi',                [AkademikController::class, 'progStuIndex']);           //index
// Route::get('akademik/kalender-akademik',            [AkademikController::class, 'kalAkIndex']);             //index
// Route::get('akademik/kemahasiswaan',                [AkademikController::class, 'KemHasIndex']);            //index

// // penelitian
// Route::resource('penelitian',                       PenelitianController::class);                           //resources

// // berita
// Route::get('berita/terkini',                        [BeritaController::class, 'berTerIndex']);              //index
// Route::get('berita/agenda',                         [BeritaController::class, 'berAgenIndex']);             //index
// Route::get('berita/laporan',                        [BeritaController::class, 'berLapIndex']);              //index
