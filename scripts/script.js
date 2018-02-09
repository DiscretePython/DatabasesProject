function showMechText()
{
    if (document.getElementById('mechCheck').checked == true)
    {
	document.getElementById('mechCertHidden').style.display = 'block';
    }
    else
    {
	document.getElementById('mechCertHidden').style.display = 'none';
    }
};

function showSalText()
{
    document.getElementById('wageBoxHidden').style.display = 'none';
    document.getElementById('salBoxHidden').style.display = 'block';
};

function showWageText()
{
    document.getElementById('wageBoxHidden').style.display = 'block';
    document.getElementById('salBoxHidden').style.display = 'none';
};
