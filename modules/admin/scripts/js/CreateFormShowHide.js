/**
 * Created by achernys on 1/30/2017.
 */

function toggle(imgElem, divId) {

    if(document.getElementById) {

        var divElem = document.getElementById(divId);

        if(divElem.className == "create closed") {

            //imgElem.src = "http://www.prompribor.by/img/menu_opened.gif";
            divElem.className = "create opened";
            //imgElem.InnerText = 'Открыть';
            //document.getElementById("linkname").InnerText = 'Открыть';

        } else {

            //imgElem.src = "http://www.prompribor.by/img/menu_closed.gif";
            divElem.className = "create closed";
            //imgElem.InnerText = 'Закрыть';
            //document.getElementById("linkname").InnerText = 'Закрыть';

        }
    }

}
