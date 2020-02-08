package ep.rest

import java.io.Serializable

data class Book(
        val ID: Int = 0,
        val IDAVTORJA: String = "",
        val NASLOV: String = "",
        val OPISKNJIGE: String = "",
        val CENA: Double = 0.0) : Serializable
