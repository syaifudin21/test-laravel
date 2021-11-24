## setup
**run in console**
1. install requirements 
```
composer install
```
2. login mysql & create new database sample_test
```
>> mysql -u root
>> mysql> create database sample_test;
```
3. run DB migration
```
php artisan migrate
```
*`data dummy yang sudah ada di database dapat diubah`*

## kasus
`user(siswa) masuk ke sebuah sistem dan ingin melihat apakah sekolahnya memiliki tracer study`
## pertanyaan
1. **buat 1 buah endpoint method GET untuk mengambil data sekolah yang memiliki tracer study berdasarkan target kelulusan siswa dan publikasi tarcer study menggunakan raw query di singgle transaction**

### *`dari sisi sekolah`*
2. **buat 1 buat endpoint method POST untuk membuat Tracer Study**
3. **buat 1 buat endpoint method PATCH untuk memperbarui Tracer Study**
4. **buat 1 buat endpoint method DELETE untuk menghapus Tracer Study**

>*semua API harus terautentikasi*

>*lengkapi semua endpoint dengan validasi dan error handler*

>*buat modeling terbaik*

>*semua response API berupa json*

>*jelaskan method controller yang sudah di buat dengan komentar*

<i>kenapa raw query?. performa raw query lebih baik dibandingkan dengan query builder</i>

**contoh struktur response tipe JSON**
```
{
    gpa         : <value>
    nim         : <value>
    date_start  : <value>
    date_end    : <value>
    degree_id   : <value>
    school_id   : <value>
    user_id     : <value>
    major_id    : <value>
    school      : {
        name        : <value>
        phone       : <value>
        email       : <value>
        fax         : <value>
        address     : <value>
        website     : <value>
        logo        : <value>
        postal_code : <value>
        about       : <value>
        mission     : <value>
        vision      : <value>
    },
    major       : {
        name        :  <value>
        translation :  <value>
    },
    degree      : {
        name        : <value>
        translation : <value>
    },
    tracer_study    : {
        school_id           : <value>
        name                : <value>
        description         : <value>
        target_start        : <value>
        target_end          : <value>
        publication_start   : <value>
        publication_end     : <value>
    }

}
```
