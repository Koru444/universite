    
function getRequeteHttp() {
    let xhr = null;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xhr;
}

    function envoyerRequetePromotion() {
        let requeteHttp = getRequeteHttp();

        if (requeteHttp == null) {
            alert("Impossible d'utiliser AJAX sur ce navigateur !");
        } else {
            let promos_id = document.getElementById('promos').value;
            // console.log(promos_id);
            requeteHttp.open('POST','models\\etudiant.php', true);
            requeteHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            requeteHttp.send("num_promo=" + promos_id);
            // requeteHttp.onreadystatechange = function () { recevoirPromotion(requeteHttp) };
            requeteHttp.onreadystatechange = function() {
                if (requeteHttp.readyState == 4) {
                    if (requeteHttp.status == 200) {
                        recevoirPromotion(requeteHttp);
                    } else {
                        console.error('Erreur de requête: ' + requeteHttp.status);
                    }
                }
            };
        }
    }




function recevoirPromotion(requeteHttp) {
        if (requeteHttp.readyState == 4) {
            // Si le réponse est bien envoyée
            if (requeteHttp.status == 200) {
                console.log(requeteHttp.responseText); // Vérifier la réponse du serveur
                let obj = JSON.parse(requeteHttp.responseText);
                let contenuClass = "";
                for (let i = 0; i < obj.length; i++) {
                    let eleve = obj[i];
                    contenuClass += `<tr>`;
                    contenuClass += `<td>${eleve.nom}</td>`;
                    contenuClass += `<td>${eleve.prenom}</td>`;
                    contenuClass += `<td>${eleve.nom_promo}</td>`;
                    contenuClass += 
                    `<td>
                        <select name ='statut[]'>
                            <option value="A">absent</option>
                            <option value="P">présent</option>
                            <option value="R">retard</option>
                        </select>
                    </td>`;
                    contenuClass += `</tr>`;
                }
                let select = document.getElementById("class");
                select.innerHTML = contenuClass;
            } else {
                console.error('Erreur de requête: ' + requeteHttp.status);
            }   
    }
}

