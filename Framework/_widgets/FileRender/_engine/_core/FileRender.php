<?php
  namespace Framework\_widgets\FileRender\_engine\_core;
  require_once($_SERVER['DOCUMENT_ROOT'] .'/Utilities/vendor/ensepar/tcpdf/tcpdf.php');
  require_once($_SERVER['DOCUMENT_ROOT'] .'/Utilities/vendor/ensepar/html2pdf/HTML2PDF.php');

  /**
   * Class: FileRender
   *    
   * Converts strings into files
   */
  class FileRender{

    /**
     * The fileinput
     * 
     * @var    $fileInput
     * @access private            
     */
    private $fileInput = null;

    /**
     * File path and name
     * 
     * @var    $filePathName
     * @access private            
     */
    private $filePathName = null;

    /**   
     * Constructs a FileRender object that generates a file
     *
     * @access public
     */
    public function __construct($fileInput, $filePathName){
      $this->fileInput = $fileInput;
      $this->filePathName = $filePathName;
    }

    /**   
     * Creates and saves a txt file from the fileInput and filePathName
     *
     * @return string
     * @access public
     */
    public function createTxtFile(){
      file_put_contents($this->filePathName, $this->fileInput);
      return 'complete';
    }

    /**   
     * Creates and saves a PDF file from the fileInput and filePathName
     *
     * @return string
     * @access public
     */
    public function createPDF(){
      try {
        $html2pdf = new \HTML2PDF('P', 'A4', 'en');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($this->fileInput);
        $html2pdf->Output($this->filePathName, 'F');
        return 'complete';
      } catch(HTML2PDF_exception $e) {
        return $e;
      }
    }
  }
?>