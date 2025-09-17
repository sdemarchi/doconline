<style>
    #contenedor-documento{
        font-size: 14px;
        padding-left:35px;
        padding-right:35px;
        font-family: "DejaVu Serif", serif;
    }

    h4{
        font-size: 15px;
        margin-bottom: 8px;
        margin-top:25px;
    }

    #vocativo{
        font-size: 14px;
        margin-bottom:20px;
    }

    .inciso p{
        text-align: justify;
        text-indent: 2em;
        margin:0;
        line-height: 1.4;
    }

    #titulo{
        text-align:center;
        margin-bottom:40px;
    }


    @page {
        margin-top: 60px;
    }
</style>



<div id="contenedor-documento">
   <h4 id="titulo"><u>INTERPONE AMPARO POR MORA</u></h4>
    <p id="vocativo"><b>SR JUEZ FEDERAL:</b></p>
    <div class="inciso">
        <p>
            <b>{{ucwords(strtolower($paciente->nom_ape))}}</b> DNI <b>{{$paciente->dni}}</b> con el patrocinio letrado del <b>Dr. Guillermo Francisco ROBLES</b>, abogado, T° 509 F° 197, CUIT N° 20374758994, con domicilio real en la calle <b>{{$paciente->domicilio}}, {{ $paciente->localidad}}, {{$paciente->provincia->Provincia}}</b> y procesal constituido en <b>San Martín 77</b> de esta ciudad. Constituyendo domicilio electrónico en el CUIT: 20374758994 (Datos de Contacto: Estudio Jurídico ROBLES - Tel: 3517685657 - Mail: guifranrob@gmail.com), se presenta y respetuosamente dice:
        </p>
    </div>


    <h4 class="titulo-inciso">I. <u>OBJETO:</u></h4>
    <div class="inciso">
        <p>
            Que vengo por la presente a <b>interponer formal Acción de Amparo por Mora</b> conforme el artículo 28 de la Ley 19.549 contra el Registro del Programa de Cannabis (REPROCANN) <b>dependiente del Ministerio de Salud de la Nación</b>, con domicilio en Av. 9 de Julio 1925, Ciudad Autónoma de Buenos Aires, CUIT: 30-54666342-2, en virtud del <b>SILENCIO DE LA ADMINISTRACIÓN</b> ante el pedido de inscripción del amparista ante el registro público que autoriza al autocultivo o cultivo delegado de plantas de cannabis para aquellos pacientes que tengan prescripción médica.
        </p>
        <p>
            Que, en tal sentido, y en base a los argumentos de hecho y de derecho que a continuación se manifiestan, solicito se emplace a la Administración a contestar de manera inmediata el pedido de inscripción atento a estar agotada la vía administrativa sin respuesta alguna, lo que ocasiona una lesión directa y ostensible sobre derechos constitucionalmente protegidos, como la salud, la libertad y la igualdad ante la ley.
        </p>
    </div>

    <h4 class="titulo-inciso">II. <u>HECHOS:</u></h4>
    <div class="inciso">
        <p>
            Con el aval del profesional de salud <b>Dr. Joaquín JOZAMI</b>, el amparista completó la 'Solicitud de Inscripción al Registro Nacional de Pacientes en Tratamiento con Cannabis (REPROCANN)' y firmó el 'Consentimiento Informado Bilateral'.
        </p>
        <p>
            El trámite cuyas constancias para identificación e individualización obran en la documental que se adjunta al presente, <b>al día de hoy se encuentra en estado “PENDIENTE DE EVALUACIÓN”</b> pese a que se encuentran holgadamente cumplidos los plazos previstos por la normativa aplicable.
        </p>
        <p>
            Esta falta de contestación evidencia una conducta pasiva y contraria al deber de la Administración de brindar respuesta a las peticiones formuladas por los particulares, en los plazos y formas que establece la normativa vigente.
        </p>
        <p>
            Ante la falta de respuesta por parte de la Administración, y habiendo transcurrido en exceso el plazo legal establecido por el <b>artículo 10 de la Ley N.º 19.549 de Procedimiento Administrativo</b>, sin que se haya emitido resolución alguna respecto a la solicitud de inscripción en el Registro Nacional,<b> el peticionante se ve en la obligación de recurrir a la presente vía judicial</b> a fin de obtener una respuesta efectiva por parte del Estado.
        </p>
        <p>
            Queda configurado el silencio de la administración previsto en el inciso a) del artículo 10 de la Ley Nacional de Procedimientos Administrativos N.º 19.549, modificada por la Ley N.º 27.742 (Ley Bases), lo cual habilita la posibilidad de requerir judicialmente que se ordene el pronto despacho de las actuaciones administrativas.
        </p>
        <p>
            Debe recordarse que toda persona tiene derecho a obtener una respuesta oportuna a sus peticiones. <b>La demora injustificada en la tramitación e inscripción del suscripto</b> —aún cuando el paciente ha cumplido con todos los requisitos establecidos por la normativa vigente— desconoce la complejidad inherente a las patologías que motivan la solicitud de acceso al tratamiento con cannabis medicinal. Esta omisión por parte de la administración pasa por alto la singularidad clínica de cada paciente, desconociendo que, en ejercicio de su autonomía y bajo adecuada supervisión médica, debe poder acceder a un abanico terapéutico lo suficientemente amplio como para contemplar su historia médica, necesidades concretas y respuesta individual al tratamiento.
        </p>
        <p>
            Es importante destacar <b>situación de absoluta vulnerabilidad a la que el Ministerio de Salud expone al amparista</b>, ya que se encuentra ante la necesidad imperiosa de acceder a un producto cuya oferta está sumamente restringida por prohibiciones estatales, lo que lo expone a un riesgo permanente para su obtención. Es por esta razón que solicita imperiosamente que se le permita actuar conforme a derecho y se autorice el acceso a su medicación.
        </p>
    </div>


    <h4 class="titulo-inciso">III. <u>MARCO NORMATIVO:</u></h4>
    <div class="inciso">
        <p>
            La Ley 27.350, sancionada en marzo de 2017 por el Congreso Nacional, establece medidas para garantizar el derecho a la salud mediante la promoción, prevención, y acceso gratuito a tratamientos con cannabis. Este marco legal se basa en los avances científicos sobre las propiedades medicinales del cannabis y está bajo la supervisión del Ministerio de Salud de la Nación.
        </p>
        <p>
            El Decreto 883/2020, reglamentado el 12 de noviembre de 2020, implementó el "Programa Nacional para el Estudio y la Investigación del Uso Medicinal de la Planta de Cannabis, sus Derivados y Tratamientos No Convencionales". En su artículo 8, se creó el "Registro del Programa de Cannabis" (REPROCANN), destinado a registrar pacientes con prescripción médica para autorizar el cultivo controlado de cannabis y sus derivados como tratamiento medicinal, terapéutico o paliativo del dolor. Los pacientes pueden inscribirse directamente o a través de un familiar, una tercera persona o una organización civil autorizada por la Autoridad de Aplicación.
        </p>
        <p>
            Este reglamento está alineado con recomendaciones internacionales, como las de la Organización Mundial de la Salud (OMS), que impulsan la eliminación del cannabis de la Lista IV de sustancias controladas, promoviendo así su acceso y la investigación científica sobre sus beneficios terapéuticos. La Corte Suprema de Justicia, en casos como "CSJ 417/2018/CS1.B., C. B. y otro c/ IOSPER y otros", reconoció la eficacia del aceite de cannabis para tratar enfermedades como la epilepsia refractaria, justificando la sanción de la Ley 27.350.
        </p>
        <p>
            El Ministerio de Salud implementó el sistema REPROCANN mediante la <b>Resolución 800/2021</b>, publicada el 12 de marzo de 2021, y sus normativas complementarias. La inscripción en el registro se realiza en el portal https://reprocann.salud.gob.ar, y requiere contar con una prescripción médica y firmar el "Consentimiento Informado Bilateral".
        </p>
        <p>
            Sin embargo, estas normativas no establecen plazos específicos para resolver las solicitudes de inscripción. Por ende, se aplica el plazo general de sesenta (60) días.
        </p>
        <p>
            Posteriormente, la Resolución 3132/2024 introdujo la exigencia de que el médico prescriptor cuente con una diplomatura o maestría en cannabis medicinal. Esta disposición, aunque la resolución fue derogada en mayo de 2025 por la Resolución 1780/2025, se mantuvo vigente mediante la incorporación de dicho requisito —originalmente previsto en el artículo 7— en la nueva normativa.
        </p>
        <p>
            En el caso concreto, la inscripción en el registro fue solicitada con anterioridad a la incorporación del nuevo requisito. La petición del paciente para ser incorporado al REPROCANN se realizó al amparo de la Resolución 800/2021, cumpliendo íntegramente con las exigencias legales vigentes al momento de su presentación. En consecuencia, la imposición de requisitos posteriores resultaría improcedente, por vulnerar derechos adquiridos y contravenir el principio de irretroactividad de la ley consagrado en el artículo 7 del Código Civil y Comercial de la Nación.
        </p>
        <p>
            Resulta verdaderamente inadmisible —aunque así ocurrió en la práctica— que, desde el ingreso del trámite ante el Ministerio de Salud, dicho organismo se haya abocado a modificar las condiciones y exigencias para el acceso al cannabis medicinal, sin siquiera haber analizado previamente las solicitudes de inscripción que ya se encontraban en trámite. En efecto, <b>los criterios de admisión fueron modificados en al menos dos oportunidades, mientras los expedientes</b>, como ocurre en el presente caso, <b>permanecieron completamente sin evaluación y resolución efectiva</b>.
        </p>
        <p>
            Sin perjuicio de lo anteriormente expuesto, corresponde poner de relieve que el <b>profesional médico interviniente en el presente caso cumple cabalmente con los requisitos exigidos por la normativa vigente para la prescripción de cannabis con fines terapéuticos.</b>
        </p>
        <p>
            En efecto, dicho profesional posee una diplomatura en cannabis medicinal y se encuentra debidamente inscripto en el Registro Federal de Profesionales de la Salud (REFEPS).
        </p>
        <p>
            Cabe aclarar que la falta de incorporación de esta documentación al momento del inicio del trámite no obedece a un incumplimiento sustancial, sino a una cuestión meramente temporal, ya que <b>la solicitud fue presentada con anterioridad a la entrada en vigencia de la Resolución 3132/2024 —y su modificatoria posterior, la Resolución 1780/2025—</b>, que incorporaron formalmente dichos requisitos al procedimiento de inscripción en el REPROCANN. Y al hecho que no se pueden modificar trámites existentes.

        </p>
        <p>
            Asimismo, corresponde remarcar que el Ministerio de Salud de la Nación no ha dado tratamiento a la solicitud en sede administrativa, omitiendo incluso la posibilidad de requerir subsanaciones o complementaciones por parte del profesional tratante, lo cual hubiera permitido regularizar de manera simple y directa cualquier supuesto defecto formal.
        </p>

        <h4 class="titulo-inciso">IV. <u>RESOLUCIÓN DE EXPEDIENTES ADMINISTRATIVOS ANÁLOGOS:</u></h4>
        <p>
            En primer lugar, es ampliamente conocido que cientos de miles de usuarios están registrados en el REPROCANN. Es menester destacar las decisiones administrativas tomadas en casos similares, donde otros pacientes con diagnósticos comparables han sido inscriptos en el registro cumpliendo con los requisitos legales vigentes, tal como lo ha hecho el actor. Adoptar una postura divergente respecto a los numerosos casos  análogos  podría  constituir  una  violación  a  principios constitucionales fundamentales como <b>la igualdad ante la ley, la seguridad jurídica y la prohibición de discriminación arbitraria.</b>
        </p>
        <p>
            Esto se debe a que se estarían ofreciendo respuestas contradictorias a demandas idénticas planteadas por individuos en situaciones similares. En este contexto, la Corte Suprema de la Nación estableció en la sentencia de Fallos (320:2151):<i> “El principio de la igualdad de todas las personas ante la ley según la ciencia y el espíritu de nuestra Constitución, no es otra cosa que el derecho a que no se establezcan privilegios que excluyan a unos de lo que se concede a otros en iguales circunstancias, de donde se sigue forzosamente que la verdadera igualdad consiste en aplicar en los casos ocurrentes la ley según las diferencias constitutivas de ellos”.</i>
        </p>
        <p><i>
            Asimismo, en Fallos (233:173), la Corte amplió: “La igualdad asegurada por la Constitución a los habitantes del país es la igualdad ante la ley a fin de que ninguna norma legal pueda establecer entre ellos diferencias de trato en situaciones sustancialmente idénticas”. También es relevante subrayar la Opinión Consultiva OC18/03 del 17 de septiembre de 2003 de la Corte Interamericana de Derechos Humanos, donde este órgano estableció que: “La no discriminación, junto con la igualdad ante la ley y la igual protección de la ley a favor de todas las personas, son elementos constitutivos de un principio básico y general relacionado con la protección de los derechos humanos. (...) Al hablar de igualdad ante la ley, (...) este principio debe garantizarse sin discriminación alguna. (...)”.</i>
        </p>
        <p>
            Resolver de manera contraria a la establecida en estos procesos análogos implicaría una vulneración a los <b> principios constitucionales de igualdad ante la ley, seguridad jurídica y no discriminación arbitraria</b>, por brindar respuestas contradictorias a idénticas pretensiones presentadas por sujetos en iguales situaciones. Resulta imperativo destacar que la administración está obligada a resolver la solicitud de inscripción del actor en el REPROCANN, asegurando que se aplique el principio de igualdad ante la ley y evitando cualquier forma de discriminación arbitraria, tal como se hace con otros pacientes en circunstancias similares.
        </p>
    </div>

    <h4 class="titulo-inciso">V. <u>PROCEDENCIA:</u></h4>
    <div class="inciso">
        <p>
            <b>Ley 19.549 de procedimiento administrativo en su art. 28</b> que prevé el presente remedio para la falta de respuesta de la administración. Se han cumplido todos los requisitos exigidos al momento de la inscripción y dentro de los plazos legales.
        </p>
        <p>
            Se ha presentado la solicitud de renovación en el REPROCANN en la fecha que surge de la documental que se acompaña como parte integrante de esta demanda, a través del médico tratante y mediante la plataforma correspondiente, bajo el <b>número de trámite que surge de la documentación que se acompaña</b> el cual <b>a la fecha se encuentra sin respuesta</b>. Todo según surge de la documentación que se adjunta.
        </p>
        <p>
            Queda configurado el silencio administrativo en los términos del artículo 10 de la Ley 19.549, en su redacción vigente, sin que resulte exigible la presentación previa de un pronto despacho administrativo, conforme la normativa reformada. En consecuencia, se encuentra habilitada la vía judicial pertinente, por lo que <b>solicitamos se libre pronto despacho judicial a fin de que la Administración se expida expresamente en el marco del procedimiento iniciado.</b>
        </p>

        <h4 class="titulo-inciso">VI. <u>RESERVA CASO FEDERAL:</u></h4>
        <p>
        Ante el hipotético y poco probable caso que V.S. no dicte sentencia en favor de nuestra pretensión,, se hace desde ya expresa reserva del caso Federal y del derecho a recurrir por ante la Corte Suprema de Justicia de la Nación por la vía del art. 14 de la ley 48 y tribunales internacionales de Derechos Humanos. Ello por cuanto la negativa a la apertura de esta instancia consagraría un daño irreparable, violatorio de derechos y garantías constitucionales individualizados en esta presentación.
        </p>
    </div>

    <h4 class="titulo-inciso">VII. <u>PRUEBA:</u></h4>
    <div class="inciso">
        <div style="margin-left: 25px">
        <h4 style="margin-top:5px">I. DOCUMENTAL:</h4>
            <ol>
                <li>Documento Nacional de Identidad.</li>
                <li>Captura de pantalla de la página web oficial de donde surge que el trámite iniciado se encuentra “PENDIENTE DE EVALUACIÓN”.</li>
                <li>Certificado de diplomatura en Cannabis del Dr. JOZAMI.</li>
                <li>Captura de pantalla de la inscripción del Dr. JOZAMI en el REFEPS.</li>
            </ol>

            <h4>II. DOCUMENTAL EN PODER DE LA CONTRAPARTE.</h4>
            <p>
                No obstante, cree mi parte que el presente caso es de puro derecho, para el supuesto que V.S. lo estime imperioso, solicito se intime a la demandada, en los términos del art. 388 del C.P.C.C.N., para que acompañe el expediente respecto a la solicitud de inscripción en el Registro Nacional de Pacientes en Tratamiento con Cannabis (REPROCANN).
            </p>

            <h4>III. INFORMATIVA (en subsidio)</h4>
            <p>Solicitamos que se libre oficio a la autoridad requerida a fines de que:</p>
            <ul>
                <li>Acompañe copia del expediente respecto a la solicitud de inscripción en el Registro Nacional de Pacientes en Tratamiento con Cannabis (REPROCANN).</li>
            </ul>
            </div>
    </div>

    <h4 class="titulo-inciso">VIII. <u>SOLICITUD DE PLAZO UNIFORME PARA DEOX</u></h4>
    <div class="inciso">
        <p>
            <b>Solicito a V.S. que el plazo prudencial para el DEOX no exceda los cinco días hábiles, independientemente de la jurisdicción territorial,</b> conforme a los principios de celeridad y eficacia consagrados en el nuevo artículo 28 de la Ley 19.549, sustituido por el artículo 47 de la Ley 27.742 (Ley de Bases), que establece expresamente que <b>"el juez requerirá a la autoridad administrativa interviniente que en el plazo de cinco (5) días hábiles judiciales informe las causas de la demora”.</b>
        </p>
        <p>
            Esta normativa introduce un criterio uniforme de cinco días hábiles que debe regir en todo el territorio nacional, eliminando las diferenciaciones territoriales anacrónicas que contradicen el principio constitucional de igualdad entre todos los habitantes de la Nación (art. 16 CN). La digitalización integral del sistema judicial federal ha tornado objetivamente injustificable cualquier distinción basada en distancias físicas inexistentes en el mundo digital, donde la totalidad de las actuaciones se tramitan mediante plataformas electrónicas con notificación instantánea e idéntica en todo el territorio nacional.
        </p>
        <p>
            El nuevo régimen legal del amparo por mora administrativa refleja una decisión legislativa clara de privilegiar la celeridad y la uniformidad procedimental. La naturaleza sumaria del amparo y el plazo de apelación de apenas 48 horas evidencian que cualquier DEOX superior a cinco días resulta desproporcionado e incompatible con la urgencia constitucional de este instituto destinado a proteger derechos fundamentales.
        </p>
        <p>
            La reforma introducida por la Ley de Bases establece un estándar objetivo de cinco días hábiles que debe interpretarse como el parámetro máximo de razonabilidad para todo el territorio nacional, garantizando acceso igualitario y efectivo a la tutela judicial sin discriminaciones territoriales carentes de sustento fáctico en la era digital.
        </p>
        <p>
            <b>En consecuencia, corresponde que V.S. unifique el plazo en cinco días hábiles conforme al nuevo estándar legal, eliminando diferenciaciones que violan la igualdad ante la ley y contradicen los principios de celeridad y eficacia propios del amparo por mora administrativa, tal como lo establece expresamente el artículo 47 de la Ley 27.742.</b>
        </p>
    </div>

    <h4 class="titulo-inciso">IX. <u>PETITORIO:</u></h4>
    <div class="inciso">
       <p> Conforme lo expuesto, solicito a V.S. que: </p>
        <ol>
            <li>Se me tenga por presentado en el carácter invocado y por constituido el domicilio procesal y electrónico.</li>
            <li>Se haga lugar al requerimiento de Amparo por Mora, en los términos del art. 28 de la ley 19549.</li>
            <li>Se tenga presente la documentación acompañada.</li>
            <li>Oportunamente, emplace a la Administración a contestar de manera inmediata el pedido de reinscripción al Registro Nacional de Pacientes en Tratamiento con Cannabis (REPROCANN) en plazo perentorio, con costas.</li>
        </ol>
    </div>

    <p style="text-align:right; margin-top:40px;line-height:20px">
        <b>Provea de conformidad <br/>
        SERÁ JUSTICIA</b>
    </p>

    @if ($paciente->firma_v2)
        <div style="margin-top:70px; text-align:center;">
            <img height="140px" src="{{ $paciente->firma_v2 }}" />
        </div>

    @elseif ($paciente->firma)
       <div style="margin-top:70px; text-align:right;">
            <img height="150px" src="{{ $paciente->firma }}" />
        </div>
    @endif

</div>
