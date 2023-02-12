function done_poll(){
    if(this.document.getElementById('final').innerText == "final mode activated")
    {
        document.getElementById('poll_real').style.display = 'none';
        document.getElementById('statistics_real').style.display = 'block';
        document.getElementById('poll_fake').style.display = 'block';
        document.getElementById('statistics_fake').style.display = 'none';

        document.getElementById('non-final').style.display = "none";
    }
    else
    {
        document.getElementById('poll_real').style.display = 'block';
        document.getElementById('statistics_real').style.display = 'none';
        document.getElementById('poll_fake').style.display = 'none';
        document.getElementById('statistics_fake').style.display = 'block';

        document.getElementById('non-final').style.display = "block";
    }
}