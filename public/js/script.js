function getRequeteHttp() {
    let requeteHttp;
console.log(requeteHttp);
    if (window.XMLHttpRequest) {//Navigateure basé sur Mozilla
        requeteHttp = new XMLHttpRequest();
        if (requeteHttp.overrideMimeType) {//Si ça exige que le type des donnéees utilisé par le serveur soit text/xml
            requeteHttp.overrideMimeType("text/xml");
        }
    } else {
        if (window.ActiveXObject) {// Si c'est internet explorer
            try {
                requeteHttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                requeteHttp = null;
            }
        }
    }
    return requeteHttp;
}

function envoyerRequetePromotion() {
    let requeteHttp = getRequeteHttp();

    if (requeteHttp == null) {
        alert("Impossible d'utiliser AJAX sur ce navigateur !");
    } else {
        let promos_id = document.getElementById('promos').value;
        console.log(promos_id);
        requeteHttp.open('POST','controllers\\Enregistrer.php', true);
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
            console.log(requeteHttp.responseText);
            // Si le réponse est bien envoyée
        if (requeteHttp.status == 200) {
            let obj = JSON.stringify(requeteHttp.responseText);
             let contenuClass = "";
            for (let i = 0; i < obj.length; i++) {
                let eleve = obj[i];
                contenuClass += `<tr>`;
                contenuClass += `<td>${eleve.nom}</td>`;
                contenuClass += `<td>${eleve.prenom}</td>`;
                contenuClass += `<td>${eleve.nom_promo}</td>`;
                contenuClass += 
                `<td>
                    <select name ='statut'>
                        <option value="A">absent</option>
                        <option value="P">présent</option>
                        <option value="R">retard</option>
                    </select>
                </td>`;
                contenuClass += `</tr>`;
            }
            let select = document.getElementById("class");
            select.innerHTML = contenuClass;
        }
    }
}

