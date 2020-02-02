package ep.rest

import retrofit2.Call
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import retrofit2.http.* //poglej v build.gradle kako includat retrofit2 !

object BookService {

    interface RestApi {

        companion object {
            const val URL = "http://10.0.2.2:8080/netbeans/mvc-rest/api/"
        }

        @GET("books")
        fun getAll(): Call<List<Book>>

        @GET("books/{id}")
        fun get(@Path("id") id: Int): Call<Book>


        @DELETE("books/{id}")
        fun delete(@Path("id") id: Int): Call<Void>


        @FormUrlEncoded
        @POST("books") //post request na url /books (books se doda unem zgornjem url)
        fun insert(@Field("author") author: String, //sprejme te parametre
                   @Field("title") title: String, //@Field pomeni da so stvari v bodyju zahtevka
                   @Field("price") price: Double,
                   @Field("year") year: Int,
                   @Field("description") description: String): Call<Void>

        @FormUrlEncoded
        @PUT("books/{id}")
        fun update(@Path("id") id: Int, //@Path pa pomeni, da je v URL parameter
                   @Field("author") author: String,
                   @Field("title") title: String,
                   @Field("price") price: Double,
                   @Field("year") year: Int,
                   @Field("description") description: String): Call<Void>
    }

    val instance: RestApi by lazy { //to nardimo enkrat, v vseh naslednjih primerih uporabljaj reusaj isti objekt
        val retrofit = Retrofit.Builder()
                .baseUrl(RestApi.URL)//uporabimo korenski url
                .addConverterFactory(GsonConverterFactory.create()) // sparsamo podatke
                .build()

        retrofit.create(RestApi::class.java)
    }
}
