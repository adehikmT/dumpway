function jabat_tangan(jml_orang=0){

    var result;
    for(var a=0;a<(jml_orang-1)*jml_orang;a++){
        //var a menampung jumlah jabat tangan;
    }

    if(jml_orang<=0){
    result="Tidak Ada Jabat Tangan.";
    }else{
    result="jumlah orang "+jml_orang+" Jumlah Jabat Tangan "+a;
    }

    console.log("result : "+result);
}

jabat_tangan(10);

