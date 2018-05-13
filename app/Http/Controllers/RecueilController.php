<?php

namespace GameSheets\Http\Controllers;

use GameSheets\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPePub\Core\EPub;

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

            $blogurl = "pwf-gamesheets.fr";
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

        else{
            var_dump("pdf");
            die();
        }



    }
}
