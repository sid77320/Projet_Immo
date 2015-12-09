<html lang="fr">
         <!-- SEARCH ZONE -->

            <div class="container search">
                <form action="?page=FC_resultatRecherche" method="GET">
                    <input type="hidden" value="FC_resultatRecherche" name="page"/> 
                    <div class="form-inline">
                        <div class="form-group col-sm-5">

                            <input type="text" class="form-control col-sm-12" name="bVille" id="bVille" placeholder="Ville">
                        </div>

                        <div class="form-group col-sm-3">

                            <select type="text" class="form-control col-sm-12" name="bType" id="bType">
                                <option value="" selected>Type de bien</option>
                                <option value="0">Appartement</option>
                                <option value="1">Maison</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-sm-4">
                        <div class="col-sm-10">
                            <button name="submit" type="submit" class="btn btn-primary">Rechercher</button>
                        </div>
                    </div>

                    <div class="form-inline">
                        <div class="form-group col-sm-2">

                            <input type="text" class="form-control col-sm-6" name="bSurface" id="bSurface" placeholder="Surface minimum en M²">
                        </div>
                        <div class="form-group col-sm-3">
                            <input type="text" class="form-control col-sm-6" name="bPrix" id="bPrix" placeholder="Loyer Maximum">
                        </div>  
                        <div class="form-group col-sm-3">
                            <select type="text" class="form-control col-sm-10" name="bPieces" id="bPieces">
                                <option value="" selected>Nombre de Pièces</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5 et +</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <a class="col-sm-4" href="#">+ de critères</a>
                        </div>
                    </div> </form>
                   </div>
</html>
