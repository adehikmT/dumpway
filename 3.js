function cetak(p=0){
  var a="";
  var center="";
  var n_center=p/2+0.5-1;
  
  for(var x=0;x<p;x++)
  {
    for(var i=1;i<p;i++)
    {
      a="*";
      for(var b=0;b<p-2;b++){
        a+="=";
      }
      a+="*";
    }
    
    if(n_center==x){
       for(var i=1;i<p;i++)
		{
		a="*";
			for(var b=0;b<p-2;b++){
			a+="*";
			}
		a+="*";
		}
		console.log(a);
		console.log("");
    }else{
       console.log(a);
       console.log(""); 
    }

  }
    // console.log(a);
}

cetak(11);
