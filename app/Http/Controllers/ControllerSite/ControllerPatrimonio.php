<?php

namespace App\Http\Controllers\ControllerSite;

//require __DIR__ . "/vendor/autoload.php";
use App\Http\Requests\UniqueQrCodeRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use Illuminate\Http\Request;
use App\Models\ModelSite\patrimonio;
use App\Models\ModelSite\sala;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\File;
use App\Models\ModelSite\setor;

use ZipArchive;

class ControllerPatrimonio extends Controller
{

    private $objpatrimonio;
    private $objsala;
    public function __construct()
    {
        $this->objpatrimonio = new patrimonio();
        $this->objsala = new sala();
    }
    public function index()
    {
        dd($this->objsala->find(3)->relPatrimonio);
    }
    public function store(ImportRequest $request, patrimonio $patrimonio)
    {
        if ($request->hasFile('arquivo')) {
            $extension = $request->file('arquivo')->getClientOriginalExtension();
            if ($extension != 'csv') {
                return redirect()->route('Import')->with('message', 'Apenas arquivos com extensão ".csv" ');
            } else {
                if ($request->Selects == 1) {
                    $insertSetor = false;
                    $insertSala = false;
                    $obj = fopen($request->file('arquivo'), 'r');
                    $sala =  fgetcsv($obj);
                    while (($dados = fgetcsv($obj, 1000, ',')) !== FALSE) {
                        if ($dados[0] != 'Unidade Gestora') {
                            $setor = $dados[0];
                            $sala = $dados[1];
                        }
                    }
                    $setorExist = setor::select("nome")->where("nome", 'Informática')->exists();
                    if ($setorExist == true) {
                        $insertSetor = true;
                    } else {
                        if (setor::insert([
                            'nome' => $setor
                        ])) {
                            $insertSetor = true;
                        }
                    }

                    if ($CodSetor = setor::where("nome",  $setor)->get("CodSetor")) {
                        if (sala::insert([
                            'CodSetor' => $CodSetor[0]["CodSetor"],
                            'nome' =>  $sala
                        ])) {
                            $insertSala = true;
                        }
                    }
                    if ($insertSetor == true && $insertSala == true) {
                        $obj = fopen($request->file('arquivo'), 'r');
                        while (($dados = fgetcsv($obj, 1000, ',')) !== FALSE) {
                            if ($dados[0] != 'Unidade Gestora') {
                                $dado = sala::where("nome",  $sala)->get("CodSala");
                                patrimonio::insert(
                                    [
                                        'CodPatrimonio' => "$dados[2]",
                                        'CodSala' => $dado[0]['CodSala'],
                                        'Unidade Gestora' => "$dados[0]",
                                        'Unidade' => "$dados[1]",
                                        'DataTombamento' => "$dados[3]",
                                        'DataGarantia' => "$dados[4]",
                                        'Denominacao' => "$dados[6]",
                                        'Marca' => "$dados[9]",
                                        'Estado' => "$dados[10]",
                                        'Finalidade' => "$dados[12]",
                                        'Depreciavel' => "$dados[14]",
                                        'Valor' => "$dados[19]",
                                        'Alterou' => 0,
                                        'Verificado' => 0,
                                        'NovoEstado' =>''


                                    ]
                                );
                            }
                        }
                    }
                    unlinkRecursive(public_path() . '/Qrcodes', false);
                    array_map('unlink', glob(public_path() . "/*.zip"));
                    file_put_contents("$sala" . ".zip", '');
                    $obj = fopen($request->file('arquivo'), 'r');
                    while (($dados = fgetcsv($obj, 1000, ',')) !== FALSE) {
                        if ($dados[0] != 'Unidade Gestora') {
                            $result = Builder::create()
                                ->writer(new PngWriter())
                                ->writerOptions([])
                                ->data($dados[2])
                                ->encoding(new Encoding('UTF-8'))
                                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                                ->size(300)
                                ->margin(10)
                                ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                                ->labelText($dados[2])
                                ->labelFont(new NotoSans(20))
                                ->labelAlignment(new LabelAlignmentCenter())
                                ->build();
                            $result->saveToFile(public_path() . "\Qrcodes\qrcode" . "$dados[2]" . ".png");
                        }
                    }
                    $zip = new ZipArchive;
                    $fileName = "$sala" . ".zip";
                    $zipPath = public_path($fileName);
                    if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
                        // arquivos que serao adicionados ao zip
                        $files = File::files(public_path('Qrcodes'));

                        foreach ($files as $key => $value) {
                            // nome/diretorio do arquivo dentro do zip
                            $relativeNameInZipFile = basename($value);

                            // adicionar arquivo ao zip
                            $zip->addFile($value, $relativeNameInZipFile);
                        }
                        // concluir a operacao
                        $zip->close();
                    }
                    return response()->download($zipPath);
                }
                if ($request->Selects == 2) {
                    $insertSetor = false;
                    $insertSala = false;
                    $obj = fopen($request->file('arquivo'), 'r');
                    $sala =  fgetcsv($obj);
                    while (($dados = fgetcsv($obj, 1000, ',')) !== FALSE) {
                        if ($dados[0] != 'Unidade Gestora') {
                            $setor = $dados[0];
                            $sala = $dados[1];
                        }
                    }
                    $setorExist = setor::select("nome")->where("nome", 'Informática')->exists();
                    if ($setorExist == true) {
                        $insertSetor = true;
                    } else {
                        if (setor::insert([
                            'nome' => $setor
                        ])) {
                            $insertSetor = true;
                        }
                    }

                    if ($CodSetor = setor::where("nome",  $setor)->get("CodSetor")) {
                        if (sala::insert([
                            'CodSetor' => $CodSetor[0]["CodSetor"],
                            'nome' =>  $sala
                        ])) {
                            $insertSala = true;
                        }
                    }
                    if ($insertSetor == true && $insertSala == true) {
                        $obj = fopen($request->file('arquivo'), 'r');
                        while (($dados = fgetcsv($obj, 1000, ',')) !== FALSE) {
                            if ($dados[0] != 'Unidade Gestora') {
                                $dado = sala::where("nome",  $sala)->get("CodSala");
                                patrimonio::insert(
                                    [
                                        'CodPatrimonio' => "$dados[2]",
                                        'CodSala' => $dado[0]['CodSala'],
                                        'Unidade Gestora' => "$dados[0]",
                                        'Unidade' => "$dados[1]",
                                        'DataTombamento' => "$dados[3]",
                                        'DataGarantia' => "$dados[4]",
                                        'Denominacao' => "$dados[6]",
                                        'Marca' => "$dados[9]",
                                        'Estado' => "$dados[10]",
                                        'Finalidade' => "$dados[12]",
                                        'Depreciavel' => "$dados[14]",
                                        'Valor' => "$dados[19]",
                                        'Alterou' => 0,
                                        'Verificado' => 0,
                                        'NovoEstado' =>''


                                    ]
                                );
                            }
                        }
                    }
                    return redirect()->route('Import');
                }
                if ($request->Selects == 3) {
                    function unlinkRecursive($dir, $deleteRootToo)
                    {
                        if (!$dh = @opendir($dir)) {
                            return;
                        }
                        while (false !== ($obj = readdir($dh))) {
                            if ($obj == '.' || $obj == '..') {
                                continue;
                            }

                            if (!@unlink($dir . '/' . $obj)) {
                                unlinkRecursive($dir . '/' . $obj, true);
                            }
                        }
                        closedir($dh);
                        if ($deleteRootToo) {
                            @rmdir($dir);
                        }
                        return;
                    }
                    $obj = fopen($request->file('arquivo'), 'r');
                    while (($salas = fgetcsv($obj, 1000, ',')) !== FALSE) {
                        if ($salas[0] != 'Unidade Gestora') {
                            $sala = $salas[1];
                        }
                    }
                    unlinkRecursive(public_path() . '/Qrcodes', false);
                    array_map('unlink', glob(public_path() . "/*.zip"));
                    file_put_contents("$sala" . ".zip", '');
                    $obj = fopen($request->file('arquivo'), 'r');
                    while (($dados = fgetcsv($obj, 1000, ',')) !== FALSE) {
                        if ($dados[0] != 'Unidade Gestora') {
                            $result = Builder::create()
                                ->writer(new PngWriter())
                                ->writerOptions([])
                                ->data($dados[2])
                                ->encoding(new Encoding('UTF-8'))
                                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                                ->size(300)
                                ->margin(10)
                                ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                                ->labelText($dados[2])
                                ->labelFont(new NotoSans(20))
                                ->labelAlignment(new LabelAlignmentCenter())
                                ->build();
                            $result->saveToFile(public_path() . "\Qrcodes\qrcode" . "$dados[2]" . ".png");
                        }
                    }
                    $zip = new ZipArchive;
                    $fileName = "$sala" . ".zip";
                    $zipPath = public_path($fileName);
                    if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
                        // arquivos que serao adicionados ao zip
                        $files = File::files(public_path('Qrcodes'));

                        foreach ($files as $key => $value) {
                            // nome/diretorio do arquivo dentro do zip
                            $relativeNameInZipFile = basename($value);

                            // adicionar arquivo ao zip
                            $zip->addFile($value, $relativeNameInZipFile);
                        }
                        // concluir a operacao
                        $zip->close();
                    }
                    return response()->download($zipPath);
                }
            }
        } else {
            return 'Envie um arquivo valido';
        }
    }
    public function deletePatrimonios(patrimonio $patrimonio, $id)
    {
        $query = $patrimonio::where('CodSala', $id);
        if ($query->delete()) {
            return 'Deletado';
        } else {
            return 'não deletado';
        }
    }
    public function route(Request $request)
    {
        return view('Import');
    }
    public function createUniqueQrcode(UniqueQrCodeRequest $request)
    {
        function unlinkRecursive($dir, $deleteRootToo)
        {
            if (!$dh = @opendir($dir)) {
                return;
            }
            while (false !== ($obj = readdir($dh))) {
                if ($obj == '.' || $obj == '..') {
                    continue;
                }

                if (!@unlink($dir . '/' . $obj)) {
                    unlinkRecursive($dir . '/' . $obj, true);
                }
            }
            closedir($dh);
            if ($deleteRootToo) {
                @rmdir($dir);
            }
            return;
        }
        unlinkRecursive(public_path() . '/QrcodesUnicos', false);
        array_map('unlink', glob(public_path() . "/*.zip"));
        file_put_contents("QrcodesÚnicos.zip", '');
        $Qrcodes = array();
        $Qrcodes = explode(';', $request->qrcodes);
        foreach ($Qrcodes as $qrcode) {
            if ($qrcode != null) {
                $result = Builder::create()
                    ->writer(new PngWriter())
                    ->writerOptions([])
                    ->data($qrcode)
                    ->encoding(new Encoding('UTF-8'))
                    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                    ->size(300)
                    ->margin(10)
                    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                    ->labelText($qrcode)
                    ->labelFont(new NotoSans(20))
                    ->labelAlignment(new LabelAlignmentCenter())
                    ->build();
                $result->saveToFile(public_path() . "\QrcodesUnicos\qrcode" . "$qrcode" . ".png");
            }
        }
        $zip = new ZipArchive;
        $fileName = "QrcodesÚnicos.zip";
        $zipPath = public_path($fileName);
        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            // arquivos que serao adicionados ao zip
            $files = File::files(public_path('QrcodesUnicos'));

            foreach ($files as $key => $value) {
                // nome/diretorio do arquivo dentro do zip
                $relativeNameInZipFile = basename($value);

                // adicionar arquivo ao zip
                $zip->addFile($value, $relativeNameInZipFile);
            }
            // concluir a operacao
            $zip->close();
        }
        return response()->download($zipPath);
    }
}
