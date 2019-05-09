<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud\Documentos;

use App\Presolicitud;
use App\Prospecto;
use App\Recibo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manualConsumidor(Prospecto $prospecto, Presolicitud $presolicitud)
    {
        $plan = $presolicitud->cotizacion()->plan;
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.manual_pdf',['presolicitud'=>$presolicitud,'plan'=>$plan]);
        // return $pdf->stream();
        return $pdf->download('manual_del_consumidor'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno."contrato.pdf");
    }
    public function consentimientoSeguro(Prospecto $prospecto, Presolicitud $presolicitud){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.consentimiento_seguro_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        // return $pdf->stream();
        return $pdf->download('consentimiento_seguro'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function avisoPrivacidad(Prospecto $prospecto, Presolicitud $presolicitud){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.aviso_privacidad_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        // return $pdf->stream();
        return $pdf->download('aviso_Privacidad'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
    }
    public function cuestionarioCalidad(Prospecto $prospecto, Presolicitud $presolicitud){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.cuestionario_calidad_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        // return $pdf->stream();
        return $pdf->download('cuestionario_calidad'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function contrato(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo)
    {
        $recibos = $presolicitud->recibos;
        $plan = $presolicitud->cotizacion()->plan;
        $monto = $recibo->monto;
        $cuota_inscripcion = $monto*($plan->inscripcion/100);
        $iva_inscripcion= $cuota_inscripcion*0.16;
        $aportacion_periodica = $monto/$plan->plazo;
        $cuota_administracion = $monto*($plan->cuota_admon/100);
        $iva_cuota_admon = $cuota_administracion*0.16;
        $seguro_vida = $monto*($plan->s_v/100);
        $primera_cuota_periodica_total = $aportacion_periodica+$cuota_administracion+$iva_cuota_admon+$seguro_vida;
        $suma_incripcion_y_cuota = $cuota_inscripcion+$iva_inscripcion+$primera_cuota_periodica_total;
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.contrato_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'plan'=>$plan,'recibo'=>$recibo,'monto'=>$monto,'cuota_inscripcion'=>$cuota_inscripcion,'iva_inscripcion'=>$iva_inscripcion,'aportacion_periodica'=>$aportacion_periodica,'cuota_administracion'=>$cuota_administracion,'iva_cuota_admon'=>$iva_cuota_admon,'seguro_vida'=>$seguro_vida,'primera_cuota_periodica_total'=>$primera_cuota_periodica_total,'suma_incripcion_y_cuota'=>$suma_incripcion_y_cuota]);
        return $pdf->stream();
        // return $pdf->download('contrato'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
    } 

    public function cartaBienvenida(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.carta_bienvenida_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        // return $pdf->stream();
        return $pdf->download('carta_de_bienvenida'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
    }
    public function declaracionSalud(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.declaracion_salud_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]);
        // return $pdf->stream();
        return $pdf->download('declaracion_salud'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function fichaDeposito(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $contrato = $recibo->contrato;
        $plan = $presolicitud->cotizacion()->plan;
        $corrida_integrante = $plan->corrida_meses_fijos($contrato->monto)['integrante'];
        // dd($corrida_integrante);
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.ficha_deposito_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato,'recibo'=>$recibo,'plan'=>$plan,'corrida_integrante'=>$corrida_integrante]);
        return $pdf->stream();
        return $pdf->download('ficha_deposito'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function formatoDomicilio(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.domiciliacion_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud])->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download('domiciliacion'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function anexoTanda(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $cotizacion = $presolicitud->perfil->cotizacion;
        $plan = $cotizacion->plan;
        switch ($cotizacion->plan->nombre){
            case "Tanda 1":
                $puntos = 720;
                break;
            case "Tanda 2":
                $puntos = 720;
                break;
            case "Tanda 3":
                $puntos = 720;
                break;
            case "Tanda 6":
                $puntos = 720;
                break;
            case "Tanda 12":
                $puntos = 630;
                break;
            case "Tanda 12":
                $puntos = 630;
                break;
            case "Tanda 18":
                $puntos = 540;
                break;
            case "Tanda 24":
                $puntos = 630;
                break;
            case "Tanda 36":
                $puntos = 630;
                break;
        }

        $pdf = PDF::loadView('prospectos.presolicitud.documentos.anexo_tanda_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'plan'=>$plan,'recibo'=>$recibo,'cotizacion'=>$cotizacion,"puntos"=>$puntos]);
        return $pdf->stream();
        // return $pdf->download('anexo_tanda'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function anexoTandaClasica(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo)
    {
        $cotizacion = $presolicitud->perfil->cotizacion;
        $plan = $cotizacion->plan;
        switch ($cotizacion->plan->nombre){
            case "Tanda 1":
                $puntos = 720;
                break;
            case "Tanda 2":
                $puntos = 720;
                break;
            case "Tanda 3":
                $puntos = 720;
                break;
            case "Tanda 6":
                $puntos = 720;
                break;
            case "Tanda 12":
                $puntos = 630;
                break;
            case "Tanda 12":
                $puntos = 630;
                break;
            case "Tanda 18":
                $puntos = 540;
                break;
            case "Tanda 24":
                $puntos = 630;
                break;
            case "Tanda 36":
                $puntos = 630;
                break;
        }
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.anexo_tanda_clasica_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'plan'=>$plan,'recibo'=>$recibo,'cotizacion'=>$cotizacion,"puntos"=>$puntos]);
        return $pdf->stream();
    }
    public function anexoInscripcionDiferida(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo)
    {
        $cotizacion = $presolicitud->perfil->cotizacion;
        $plan = $cotizacion->plan;
        switch ($cotizacion->plan->nombre){
            case "Tanda 1":
                $puntos = 720;
                break;
            case "Tanda 2":
                $puntos = 720;
                break;
            case "Tanda 3":
                $puntos = 720;
                break;
            case "Tanda 6":
                $puntos = 720;
                break;
            case "Tanda 12":
                $puntos = 630;
                break;
            case "Tanda 12":
                $puntos = 630;
                break;
            case "Tanda 18":
                $puntos = 540;
                break;
            case "Tanda 24":
                $puntos = 630;
                break;
            case "Tanda 36":
                $puntos = 630;
                break;
        }
        $meses = [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre',
        ];
        $mes = $meses[(int)date('m')];
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.anexo_inscripcion_diferida_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'plan'=>$plan,'recibo'=>$recibo,'cotizacion'=>$cotizacion,"puntos"=>$puntos,'mes'=>$mes]);
        return $pdf->stream();

    }
 
}
