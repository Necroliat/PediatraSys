<?php
require('fpdf186/fpdf.php');


class PDF extends FPDF {
    function Header() { 
        // Título
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'Consultorio Pediatrico',0,1,'C');
        $this->Ln(10);

        // Fecha y día
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,date('d/m/Y'),0,1,'R');
        $this->Ln(10);
    }

    function Footer() {
        // Línea de firma
        $this->SetY(-80);
        $this->SetFont('Arial','I',10);
        $this->Cell(0,10,'Firma: Nombre del Doctor',0,1,'C');
    }

    function Body($doctor, $exequatur, $paciente, $descripcion) {
        $this->Cell(0,10,'Certificado Medico',0,1,'C');
        // Cuerpo del certificado
        $this->SetFont('Arial','',12);
         // Reducir el espacio antes del texto
        $this->Ln(-80); // Reducir el valor de 10 a 5, o cualquier otro valor que desees
        
        // Obtener la altura del texto
        $texto = utf8_decode('Yo, '.$doctor.', con excequatur '.$exequatur.', certifico que el joven '.$paciente.', '.$descripcion.' ');
        $ancho = 180; // Ancho máximo de la celda, en este caso, el ancho de la página
        $alto = 8; // Altura de la celda
        $alturaTexto = ceil($this->GetStringWidth($texto) / $ancho) * $alto;
    
        // Calcular la posición vertical para centrar el texto
        $y = ($this->GetPageHeight() - $this->GetY() - $alturaTexto) / 3 + $this->GetY();
    
        // Agregar el texto centrado verticalmente
        $this->SetY($y);
        $this->MultiCell($ancho, $alto, $texto, 0, 'C');
    }
}

$doctor = $_POST['txtid'];
$exequatur = $_POST['txtexequatur'];
$paciente = $_POST['txtpaciente'];
$descripcion = $_POST['txtdescripcion'];

// Crear instancia de PDF
$pdf = new PDF();
$pdf->AddPage();

// Llamar al método Body para agregar el contenido
$pdf->Body($doctor, $exequatur, $paciente, $descripcion);

// Generar el PDF
$pdf->Output();
?>