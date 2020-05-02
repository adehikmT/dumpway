function hitung_index(arr=[]){
    
    var jml_array=arr.length;
    var i=0;
    var jml_nilai=0;
    var nilai=[];

    // mencari jumlah nilai
    while(jml_array>i){
        jml_nilai+=arr[i];
        i++;
    }

    // console.log(jml_nilai);
    // mencari jml nilai - nilai index
    i=0;
    while(jml_array>i){
        nilai[i]=jml_nilai-arr[i];  
        i++;
    }

    //mengurutkan nilai index tebesar ke terkecil methode Sorting
    i=0;
    var loop=true;
    var tmp;
    while(loop){
        i++;
        loop=false;
        for(var a=0;a<i;a++){
            if(nilai[a]<nilai[a+1])
            {
            tmp=nilai[a];
            nilai[a]=nilai[a+1];
            nilai[a+1]=tmp;
            loop=true;
            }
        }
    }

    //mengambil angka ter kecil
    var desc=nilai[jml_array-1];
    // mengambil angka terbesar
    var asc=nilai[0];

    console.log("Data Array "+arr);
    console.log("angka terbesar "+asc+" angka terkecil "+desc);
}

hitung_index([1,2,10]);