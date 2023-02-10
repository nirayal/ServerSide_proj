function done_poll(){
    if(this.document.getElementById('final').innerText == "finito")
    {
        document.getElementById('poll_btn').setAttribute('disabled','true');
        document.getElementById('pool_link').href = 'index.php';
        document.getElementById('statistics_btn').removeAttribute('disabled');
        document.getElementById('statistics_link').setAttribute('href','statistics.htm');

        document.getElementById('non-final').style.display = "none";
        document.getElementById('final').style.display = "block";
    }
    else
    {
        document.getElementById('poll_btn').removeAttribute('disabled');
        document.getElementById('pool_link').setAttribute('href','poll_first_page.php');
        document.getElementById('statistics_btn').setAttribute('disabled','true');
        document.getElementById('statistics_link').href = 'index.php';

        document.getElementById('non-final').style.display = "block";
        document.getElementById('final').style.display = "block";
    }
}
