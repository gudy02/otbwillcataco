@extends('layouts.app')
@section('css')
    <style>
        .titulo{
        
        }
        .centrado{
            color: white;
            margin: 13%;
        }
        .centrado>h1{
            font-size: 4em;
        }
        .footer{
            color: white;
            margin: 5%;
        }
    </style>
@endsection
@section('content')
<div  class="container-fluid" style="background-image: url('img/fondo.jpg');background-attachment: fixed;background-size: 100%" >
    <div class="row text-center titulo" >
        <div class="centrado">
                <h1>Bienvenido al Sistema OTB Willcataco</h1>
                <h4><em>"El agua es el alma madre de la vida y la matriz no hay vida sin agua"</em></h4>
        </div>
        
    </div>
</div>
<div class="container" style="margin-top: 2%;">

    <div class="row" >
        <div class="col-xs-5">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading" align='center'>HISTORIA</div>
                        <div class="panel-body">
                           <div class="container-fluid">
                                En  la comunidad de willcataco,perteneciente al municipio de  Colcapirhua,quinta seccion  de la provincia
                            quillacollo del departamento de cochabamba ,en 1998 se fundo el 'Sistema de Agua pPotable O.T.B.
                            Willcataco'  misma que agrupa los pobladores organizados de la comunidad y representantes por su directorio
                            nombrados democraticamente en una asamblea General de usuarios y/o Asociados.
                            El Sistema de Aqua Potable O.T.B.Wilcataco perteneciente al municipio de Colcapirhua,quinta seccion de
                            Quillacollodel departamento de Cochabamba,tiene los siguientes fines:
                            Contribuir al desarrollo integral de los usuarios del agua potable y elevar su nivel de vida de forma
                            viable y sostenible.
                            Lograr la consolidacion de comunarios del sistema de agua potable del municipio de Colcapirhua.
                            Apoyar a laconservacion, operacion, mantenimiento, complementacion y manejo sotenible de los sistemas de
                            construccion de agua potable y los recursos naturales de la comunidad.
                            Consolidar el Sistema de Agua PotableO.T.B.Willcataco fortaleciendo todas sus instancias.
                           </div>
                        </div>
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="col-xs-4">
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading" align='center'>VISION</div>
                        <div class="panel-body">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores consequatur animi possimus nisi, saepe excepturi magni qui et quia maxime doloribus voluptatibus repudiandae fuga reiciendis dolorem labore ducimus error explicabo.
                        </div>
    
                    </div>
                </div>
            </div>
          </div>
          <div class="col-xs-3">
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading" align='center'>MISION</div>
                        <div class="panel-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, dolorem molestiae quisquam sapiente inventore dicta delectus minima optio. Dignissimos amet molestiae sed qui aut quod pariatur non porro expedita voluptatum?
                        </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="bottom: 0;background-image: url('img/footer.jpg');background-attachment: fixed;background-size: 100%">
        <div class="row footer text-center">
            <div class="col-xs-6">
                Contactanos <br>  
                    -Email Carlos Vedia:carlosvedia59@gmail.com <br>
                    -Email Cristian:cmeridag@gmail.com <br>
                    -Telefono Carlos Vedia: 77486756 <br>
                    -Telefono Carlos Merida: 69491355 <br>
            </div>
            <div class="col-xs-6">
                Sobre Nosotros
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates dolor earum quidem saepe error expedita dolorum consequuntur commodi odio veritatis, cumque eaque harum vero quis natus numquam deleniti ipsum aliquam.</p>
            </div>

        </div>
    </div>
        @endsection
        