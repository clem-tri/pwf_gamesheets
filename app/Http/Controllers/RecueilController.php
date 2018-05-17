<?php

namespace GameSheets\Http\Controllers;

use GameSheets\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPePub\Core\EPub;
use Codedge\Fpdf\Fpdf\Fpdf;
class RecueilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recueils.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Generate ePub
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request){

        if($request->generate == "epub"){

            $this->createEpub($request);
        }

        else{
            $this->createPDF($request);
        }



    }

    public function createEpub(Request $request){
        $selectedFiches = $request->Fiches;
        $fichesData = Fiche::whereIn('id', $selectedFiches)->get();
        $book = new EPub();

        $content_start =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"
            . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"\n"
            . "    \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n"
            . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n"
            . "<head>"
            . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n"
            . "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\" />\n"
            . "<title>Test Book</title>\n"
            . "</head>\n"
            . "<body>\n";


        $content_end = "</body></html>";

        $blogurl = "pwf-gamesheets/";
        $cssData = file_get_contents(asset("css/app.css"));
        $creationDate = date("d-m-Y-h-i-s");

        $book->setLanguage('fr');

        $book->setTitle("Recueil Gamesheets".$creationDate);
        $authorname = Auth::user()->name;
        $book->setAuthor($authorname, $authorname);
        $book->setIdentifier($blogurl . "&amp;stamp=" . time(), EPub::IDENTIFIER_URI);
        $book->addCSSFile("styles.css", "css1", $cssData);
        $cover = $content_start . "<h1>" . $book->getTitle() . "</h1>\n";
        if ($authorname) {
            $cover .= "<h2>By: $authorname</h2>\n";
        }
        $cover .= "<h2>From: <a href=\"$blogurl\">$blogurl</a></h2>";
        $cover .= $content_end;
        $book->buildTOC();
        $book->addChapter($book->getTitle(), "Cover.html", $cover);

        foreach ($fichesData as $fiche){

            // infos fiche
            $enligne = $fiche->en_ligne == 1 ? 'Oui' : 'Non';
            $genre = $fiche->genre;
            $author = $fiche->user;
            $editeur = $fiche->editeur;
            $dev = $fiche->developpeur;
            $site = '';
            $plateformes = "";
            $extensions = "";
            $pictogrammes = "";

            if($fiche->site){
                $site = "
                <div class='form-group'>
                    <h5 class='title'>Site internet :</h5>
                    <p class='text'><a href='$fiche->site'>$fiche->site</a></p>
                </div>
                <hr/>";
            }

            // plateformes
            foreach ($fiche->plateformes as $plateforme){
                $plateformes .= "<div> $plateforme->nom </div>";
            }


            // extensions
            foreach($fiche->extensions as $extension){
                $extensions.= " <div><span class='badge badge-pill badge-light'>$extension->nom</span></div>";
            }

            if($extensions != ''){
                $extensions=

                    "<div class='form-group'>
                               <h5 class='title'>Extensions :</h5>
                                <p class='text'>".$extensions." </p>
                        </div>
                            <hr/>";
            }

            // pictogrammes
            foreach($fiche->pictogrammes as $pictogramme){
                $pictogrammes .= "<img class='img-responsive' style='width: 20%!important;' src='img/$pictogramme->logo' />";

            }

            if($pictogrammes != ''){
                $pictogrammes = "<div class='form-group'>$pictogrammes</div>";
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);


            // Image jaquette
            $book->addFile("img/".$fiche->image,
                uniqid(),
                file_get_contents(asset("storage/".$fiche->image)),
                finfo_file($finfo,"storage/".$fiche->image));


            //Image éditeur
            if(!in_array("img/".$editeur->logo,$book->getFileList())){
                $book->addFile("img/".$editeur->logo,
                    uniqid(),
                    file_get_contents(asset("storage/".$editeur->logo)),
                    finfo_file($finfo,"storage/".$editeur->logo));
            }

            //Image developpeur
            if(!in_array("img/".$dev->logo,$book->getFileList())) {
                $book->addFile("img/" . $dev->logo,
                    uniqid(),
                    file_get_contents(asset("storage/" . $dev->logo)),
                    finfo_file($finfo,"storage/".$dev->logo));
            }

            //Pictogrammes fiche
            foreach($fiche->pictogrammes as $pictogramme){

                if(!in_array("img/".$pictogramme->logo, $book->getFileList())){
                    $book->addFile("img/" . $pictogramme->logo,
                        uniqid(),
                        file_get_contents(asset("storage/" . $pictogramme->logo)),
                        finfo_file($finfo,"storage/".$pictogramme->logo));
                }
            }
            // Contenu HTML
            $book->addChapter(
                $fiche->nom,
                $fiche->nom.".html",
                $content_start .
                "<div class='text-center'>
                            
                            <div class='header'>
                               <h5 class='title'>$fiche->nom</h5>
                            </div>
                       
                            <div class='body'>
                            
                                <div class='form-group'>
                                <img  style='width: 50%!important;'  src='img/$fiche->image' alt='$fiche->nom'/>
                                </div>
                            
                            <div class='form-group'>
                            <h5 class='title'>Editeur / Developpeur :</h5>
                                <figure>
                                <img style='width: 20%!important;' alt='Editeur' class='img-responsive w-25 h-25' src='img/$editeur->logo'/>
                                <figcaption class='text font-weight-bold font-italic'>$editeur->nom</figcaption>
                                </figure>
                                
                                <figure>
                                <img  style='width: 20%!important;' alt='Developpeur' class='img-responsive w-25 h-25' src='img/$dev->logo'/>
                                <figcaption class='text font-weight-bold font-italic'>$dev->nom</figcaption>
                                </figure>
                            </div>
                            <hr/>
                             <div class='form-group'>
                                <h5 class='title'>Plateformes :</h5>
                                $plateformes
                            </div>
                            
                            <hr/>
                             <div class='form-group'>
                                <h5 class='title'>Genre :</h5>
                                <p class='text'>$genre->nom</p>
                            </div>
                            <hr/>
                             <div class='form-group'>
                                <h5 class='title'>Sortie :</h5>
                                <p class='text'>". date("d/m/Y",strtotime($fiche->annee)) ."</p>
                            </div>
                            <hr/>
                             <div class='form-group'>
                                <h5 class='title'>Synopsis :</h5>
                                <p class='text'>$fiche->synopsis</p>
                            </div>
                            
                            <hr/>
                            
                            
                                
                            $extensions
                    
                              
                            
                             <div class='form-group'>
                                <h5 class='title'>Jouable en ligne :</h5>
                                <p class='text'>
                                
                                    $enligne
                    
                                </p>
                            </div>
                            
                            $site

                            $pictogrammes    
 
                            </div>
                            
                        <div class='footer text-muted'>
                            Auteur : $author->name
                        </div>

                           
                        </div>"

                . $content_end);
        }



        $book->finalize();
        $zipData = $book->sendBook($book->getTitle());
    }

    public function createPDF(Request $request){

        $fiches = Fiche::whereIn('id', $request->Fiches)->get();


        $fpdf= new Fpdf();
        $fpdf->SetTitle('Recueil Gamesheets'. date('Y-m-d-h-i-s'));

        foreach($fiches as $fiche){


            $fpdf->SetAutoPagebreak(False);
            $fpdf->SetMargins(10,10,10);
            $fpdf->AliasNbPages();
            $fpdf->AddPage();
            // Police Arial gras 15
            $fpdf->SetFont('Arial','B', 24);
            // Décalage à droite
            $fpdf->Cell(80);
            // Titre
            $fpdf->Cell(30,0,$fiche->nom,0,0,'C');
            $fpdf->SetFont('Arial', '',12);


            // Fiche image
            list($widthJaquette, $heightJaquette, $type, $attr) = getimagesize("storage/".$fiche->image);
            $widthJaquette = ($widthJaquette / ($widthJaquette/60));
            $heightJaquette = ($heightJaquette / ($heightJaquette/60));


            $fpdf->Cell($widthJaquette,
                $heightJaquette,
                "",
                0,
                1,
                'C',
                $fpdf->Image("storage/".$fiche->image,75,30, $widthJaquette)
            );

            // Image editeur
            list($widthEditeur, $heightEditeur, $type, $attr) = getimagesize("storage/".$fiche->editeur->logo);
            $widthEditeur= ($widthEditeur / ($widthEditeur/15));
            $heightEditeur = ($heightEditeur / ($heightEditeur/15));


            $fpdf->Cell($widthEditeur,
                $heightEditeur,
                "",
                0,
                1,
                'C',
                $fpdf->Image("storage/".$fiche->editeur->logo,75,120, $widthEditeur)
            );

            // Image dev
            list($widthDev, $heightDev, $type, $attr) = getimagesize("storage/".$fiche->developpeur->logo);
            $widthDev= ($widthDev / ($widthDev/15));
            $heightDev = ($heightDev / ($heightDev/15));


            $fpdf->Cell($widthDev,
                $heightDev,
                "",
                0,
                1,
                'C',
                $fpdf->Image("storage/".$fiche->developpeur->logo,120,120, $widthDev)
            );

            // Plateformes
            $fpdf->Ln(60);
            $fpdf->SetFont('Arial','B',11);
            $fpdf->Cell(30,10,"Plateformes",0,0,'C');
            $fpdf->SetFont('Arial','',12);

            $plateformes = '';
            foreach ($fiche->plateformes as $plateforme) {
               $plateformes .= $plateforme->nom. " | ";
            }

            $fpdf->MultiCell(0,10,utf8_decode($plateformes));

            // Genre

            $fpdf->SetFont('Arial','B',11);
            $fpdf->Cell(30,10,"Genre",0,0,'C');
            $fpdf->SetFont('Arial','',12);
            $fpdf->MultiCell(0,10,utf8_decode($fiche->genre->nom));

            // Date de sortie

            $fpdf->SetFont('Arial','B',11);
            $fpdf->Cell(30,10,"Sortie",0,0,'C');
            $fpdf->SetFont('Arial','',12);
            $fpdf->MultiCell(0,10,utf8_decode(date("d/m/Y",strtotime($fiche->annee))));

            // Synopsis

            $fpdf->SetFont('Arial','B',11);
            $fpdf->Cell(30,10,"Synopsis",0,0,'C');
            $fpdf->SetFont('Arial','',12);

            $fpdf->MultiCell(0,5,utf8_decode($fiche->synopsis));

            // Extensions

            if(count($fiche->extensions) > 0) {

                $fpdf->SetFont('Arial', 'B', 11);
                $fpdf->Cell(30, 10, "Extensions", 0, 0, 'C');
                $fpdf->SetFont('Arial', '', 12);

                $extensions = '';
                foreach ($fiche->extensions as $extension) {
                    $extensions .= $extension->nom . " | ";
                }

                $fpdf->MultiCell(0,10,utf8_decode($extensions));
            }


            // Jouable en ligne

            $fpdf->SetFont('Arial','B',11);
            $fpdf->Cell(30,10,"Jouable en ligne",0,0,'C');
            $fpdf->SetFont('Arial','',12);

            $enligne = $fiche->en_ligne == 1 ? 'Oui' : 'Non';
            $fpdf->MultiCell(0,10,utf8_decode($enligne));


            // Site internet

            if($fiche->site != ''){
                $fpdf->SetFont('Arial','B',11);
                $fpdf->Cell(30,10,"Site internet",0,0,'C');
                $fpdf->SetFont('Arial','',12);
                $fpdf->SetTextColor(0,0,255);
                $fpdf->MultiCell(0,10,utf8_decode($fiche->site));
                $fpdf->SetTextColor(0,0,0);
            }

            // Pictogrammes




                foreach ($fiche->pictogrammes as $key => $pictogramme) {
                    $fpdf->Cell(50,
                        0,
                        "",
                        0,
                        1,
                        'C',
                        $fpdf->Image("storage/".$pictogramme->logo,70 + ($key * 15),250, $widthDev)
                    );
                }



            // Pied de page

            $fpdf->SetY(-15);
            $fpdf->SetFont('Arial','I',8);
            $fpdf->Cell(0,10,'Page '.$fpdf->PageNo().'/{nb}',0,0,'C');
            $fpdf->SetX(190);
            $fpdf->Cell(0,10,"Auteur: ".$fiche->user->name,0,0,'C');


        }

        $fpdf->Output('D', 'Recueil Gamesheets'. date('Y-m-d-h-i-s').'.pdf');
        exit;
    }
}
