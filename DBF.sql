--
-- PostgreSQL database dump
--

-- Dumped from database version 10.6
-- Dumped by pg_dump version 10.6

-- Started on 2018-11-09 17:03:08

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2922 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 196 (class 1259 OID 16395)
-- Name: acta_responsabilidad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.acta_responsabilidad (
    idacta integer NOT NULL,
    numdocumentoaprendiz integer NOT NULL,
    idequipo integer NOT NULL,
    fechaacta timestamp without time zone NOT NULL
);


ALTER TABLE public.acta_responsabilidad OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16398)
-- Name: acta_responsabilidad_idacta_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.acta_responsabilidad_idacta_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.acta_responsabilidad_idacta_seq OWNER TO postgres;

--
-- TOC entry 2923 (class 0 OID 0)
-- Dependencies: 197
-- Name: acta_responsabilidad_idacta_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.acta_responsabilidad_idacta_seq OWNED BY public.acta_responsabilidad.idacta;


--
-- TOC entry 198 (class 1259 OID 16400)
-- Name: ambiente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ambiente (
    idambiente integer NOT NULL,
    idprograma integer NOT NULL,
    nombreambiente character varying(50) NOT NULL,
    ubicacionambiente character varying(100)
);


ALTER TABLE public.ambiente OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 16403)
-- Name: ambiente_idambiente_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ambiente_idambiente_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ambiente_idambiente_seq OWNER TO postgres;

--
-- TOC entry 2924 (class 0 OID 0)
-- Dependencies: 199
-- Name: ambiente_idambiente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ambiente_idambiente_seq OWNED BY public.ambiente.idambiente;


--
-- TOC entry 200 (class 1259 OID 16405)
-- Name: aprendiz; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aprendiz (
    numdocumentoaprendiz double precision NOT NULL,
    numeroficha integer NOT NULL,
    nombreaprendiz character varying(50) NOT NULL,
    telefonoaprendiz double precision NOT NULL,
    emailaprendiz character varying(50) NOT NULL
);


ALTER TABLE public.aprendiz OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 16408)
-- Name: articulo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.articulo (
    idarticulo integer NOT NULL,
    idambiente integer NOT NULL,
    idequipo integer,
    idcategoria integer NOT NULL,
    tipoarticulo character varying(50) NOT NULL,
    modeloarticulo character varying(50) NOT NULL,
    marcaarticulo character varying(50),
    caracteristicaarticulo text,
    estadoarticulo character varying(10),
    numinventariosena character varying(50),
    serialarticulo character varying(50)
);


ALTER TABLE public.articulo OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 16414)
-- Name: articulo_idarticulo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.articulo_idarticulo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.articulo_idarticulo_seq OWNER TO postgres;

--
-- TOC entry 2925 (class 0 OID 0)
-- Dependencies: 202
-- Name: articulo_idarticulo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.articulo_idarticulo_seq OWNED BY public.articulo.idarticulo;


--
-- TOC entry 203 (class 1259 OID 16416)
-- Name: articulonovedad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.articulonovedad (
    idarticulo integer NOT NULL,
    idnovedad integer NOT NULL,
    tiponovedad character varying(50) NOT NULL,
    observacionnovedad text
);


ALTER TABLE public.articulonovedad OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16422)
-- Name: categoria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categoria (
    idcategoria integer NOT NULL,
    nombrecategoria character varying(50) NOT NULL
);


ALTER TABLE public.categoria OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16425)
-- Name: categoria_idcategoria_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categoria_idcategoria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categoria_idcategoria_seq OWNER TO postgres;

--
-- TOC entry 2926 (class 0 OID 0)
-- Dependencies: 205
-- Name: categoria_idcategoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categoria_idcategoria_seq OWNED BY public.categoria.idcategoria;


--
-- TOC entry 206 (class 1259 OID 16427)
-- Name: equipo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.equipo (
    idequipo integer NOT NULL,
    nombreequipo character varying(50) NOT NULL,
    estadoequipo text NOT NULL,
    numarticulosequipo character varying(50) NOT NULL,
    observacionequipo character varying(200),
    numarticulosagregados character varying(50)
);


ALTER TABLE public.equipo OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16433)
-- Name: equipo_idequipo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.equipo_idequipo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.equipo_idequipo_seq OWNER TO postgres;

--
-- TOC entry 2927 (class 0 OID 0)
-- Dependencies: 207
-- Name: equipo_idequipo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.equipo_idequipo_seq OWNED BY public.equipo.idequipo;


--
-- TOC entry 208 (class 1259 OID 16435)
-- Name: ficha; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ficha (
    numeroficha integer NOT NULL,
    idprograma integer NOT NULL,
    idambiente integer NOT NULL,
    fechainicio character varying(50) NOT NULL,
    fechafin character varying(50) NOT NULL,
    jornadaficha character varying(50) NOT NULL
);


ALTER TABLE public.ficha OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 16438)
-- Name: novedad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.novedad (
    idnovedad integer NOT NULL,
    numdocumentousuario integer NOT NULL,
    usuarionovedad character varying(50) NOT NULL,
    numeroficha integer NOT NULL,
    fechanovedad text NOT NULL,
    articulo character varying(50) NOT NULL,
    estado boolean NOT NULL
);


ALTER TABLE public.novedad OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 16444)
-- Name: novedad_idnovedad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.novedad_idnovedad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.novedad_idnovedad_seq OWNER TO postgres;

--
-- TOC entry 2928 (class 0 OID 0)
-- Dependencies: 210
-- Name: novedad_idnovedad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.novedad_idnovedad_seq OWNED BY public.novedad.idnovedad;


--
-- TOC entry 211 (class 1259 OID 16446)
-- Name: programa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.programa (
    idprograma integer NOT NULL,
    nombreprograma character varying(50) NOT NULL,
    duracionprograma character varying(50) NOT NULL,
    tipoprograma character varying(50)
);


ALTER TABLE public.programa OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 16449)
-- Name: programa_idprograma_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.programa_idprograma_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.programa_idprograma_seq OWNER TO postgres;

--
-- TOC entry 2929 (class 0 OID 0)
-- Dependencies: 212
-- Name: programa_idprograma_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.programa_idprograma_seq OWNED BY public.programa.idprograma;


--
-- TOC entry 213 (class 1259 OID 16451)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    numdocumentousuario integer NOT NULL,
    idprograma integer,
    nombreusuario character varying(50) NOT NULL,
    contraseniausuario character varying(200) NOT NULL,
    rolusuario character varying(50) NOT NULL,
    fotousuario text
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 2727 (class 2604 OID 16554)
-- Name: acta_responsabilidad idacta; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acta_responsabilidad ALTER COLUMN idacta SET DEFAULT nextval('public.acta_responsabilidad_idacta_seq'::regclass);


--
-- TOC entry 2728 (class 2604 OID 16555)
-- Name: ambiente idambiente; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ambiente ALTER COLUMN idambiente SET DEFAULT nextval('public.ambiente_idambiente_seq'::regclass);


--
-- TOC entry 2729 (class 2604 OID 16556)
-- Name: articulo idarticulo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.articulo ALTER COLUMN idarticulo SET DEFAULT nextval('public.articulo_idarticulo_seq'::regclass);


--
-- TOC entry 2730 (class 2604 OID 16557)
-- Name: categoria idcategoria; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categoria ALTER COLUMN idcategoria SET DEFAULT nextval('public.categoria_idcategoria_seq'::regclass);


--
-- TOC entry 2731 (class 2604 OID 16558)
-- Name: equipo idequipo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.equipo ALTER COLUMN idequipo SET DEFAULT nextval('public.equipo_idequipo_seq'::regclass);


--
-- TOC entry 2732 (class 2604 OID 16559)
-- Name: novedad idnovedad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.novedad ALTER COLUMN idnovedad SET DEFAULT nextval('public.novedad_idnovedad_seq'::regclass);


--
-- TOC entry 2733 (class 2604 OID 16560)
-- Name: programa idprograma; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.programa ALTER COLUMN idprograma SET DEFAULT nextval('public.programa_idprograma_seq'::regclass);


--
-- TOC entry 2897 (class 0 OID 16395)
-- Dependencies: 196
-- Data for Name: acta_responsabilidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.acta_responsabilidad (idacta, numdocumentoaprendiz, idequipo, fechaacta) FROM stdin;
\.


--
-- TOC entry 2899 (class 0 OID 16400)
-- Dependencies: 198
-- Data for Name: ambiente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ambiente (idambiente, idprograma, nombreambiente, ubicacionambiente) FROM stdin;
8	9	AMBIENTE L	
9	10	TDT	FRENTE AL AMBIENTE L
\.


--
-- TOC entry 2901 (class 0 OID 16405)
-- Dependencies: 200
-- Data for Name: aprendiz; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.aprendiz (numdocumentoaprendiz, numeroficha, nombreaprendiz, telefonoaprendiz, emailaprendiz) FROM stdin;
1232132	1493990	Melany Alejandra Rojas Troyano 	3265974231	sakdjhaskdjs@gmail.com
145645642	1493990	 Alejandra Rojas Troyano Lopez	3265974232	sakdjhaskdjs@gmail.com
789789792	1493990	Karen Molina Cobo 	3265974233	sakdjhaskdjs@gmail.com
11234352	1493990	Daniel Yordanier Valencia Troyano 	3265974234	sakdjhaskdjs@gmail.com
354646242	1493990	Nare Alejandro Manquillo Cobo	3265974235	sakdjhaskdjs@gmail.com
54665757	1493990	 Danny Peña 	3265974236	sakdjhaskdjs@gmail.com
345345243	1493990	Mariana Bolaños	3265974237	sakdjhaskdjs@gmail.com
1279878762	1493990	Tatiana Riascos	3265974238	sakdjhaskdjs@gmail.com
14563464354	1493990	Melany Alejandra Rojas Troyano 	3265974239	sakdjhaskdjs@gmail.com
65464	1493990	PEPITO	654654	asdasd@gmail.com
1456405642	123	 Alejandra Rojas Troyano Lopez	3265974232	sakdjhaskdjs@gmail.com
7897809792	123	Karen Molina Cobo 	3265974233	sakdjhaskdjs@gmail.com
110234352	123	Daniel Yordanier Valencia Troyano 	3265974234	sakdjhaskdjs@gmail.com
3546046242	123	Nare Alejandro Manquillo Cobo	3265974235	sakdjhaskdjs@gmail.com
546605757	123	 Danny Peña 	3265974236	sakdjhaskdjs@gmail.com
34530045243	123	Mariana Bolaños	3265974237	sakdjhaskdjs@gmail.com
12798078762	123	Tatiana Riascos	3265974238	sakdjhaskdjs@gmail.com
232131	123	Melany Alejandra Rojas Troyano 	3265974239	sakdjhaskdjs@gmail.com
\.


--
-- TOC entry 2902 (class 0 OID 16408)
-- Dependencies: 201
-- Data for Name: articulo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.articulo (idarticulo, idambiente, idequipo, idcategoria, tipoarticulo, modeloarticulo, marcaarticulo, caracteristicaarticulo, estadoarticulo, numinventariosena, serialarticulo) FROM stdin;
17	8	6	7	MONITOR 	QWER	LENOVO		DAÑADO	987	654
18	9	7	8	CPU	TYUIRTR	ACER		PERDIDO	693	757
19	9	\N	8	REGULADOR	BHYJF	MHJKG		ACTIVO	1474	252
20	9	6	7	QWEQE	QWEWQ	ASDASD	ASDADADASDASDAD	PERDIDO	asdasd	adsad
21	8	6	8	KIKU	UIKIUK	KUIKUIK	DGHGDHHDHDH	PERDIDO	uikuik	kjk5
22	8	\N	8	JKHJKHJ	HJKHJK	HJKHJK		DAÑADO	412bvb	cvb3522
16	8	6	7	MOUSE	ñLKJ	HP		ACTIVO	321	123
\.


--
-- TOC entry 2904 (class 0 OID 16416)
-- Dependencies: 203
-- Data for Name: articulonovedad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.articulonovedad (idarticulo, idnovedad, tiponovedad, observacionnovedad) FROM stdin;
16	27	DAÑADO	qwewerwe
17	28	PERDIDO	
21	28	DAÑADO	hjghkjjh
18	29	PERDIDO	123123
19	29	PERDIDO	585bcvbx
20	29	DAÑADO	
\.


--
-- TOC entry 2905 (class 0 OID 16422)
-- Dependencies: 204
-- Data for Name: categoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categoria (idcategoria, nombrecategoria) FROM stdin;
7	TECNOLOGIA
8	CONSTRUCCION
\.


--
-- TOC entry 2907 (class 0 OID 16427)
-- Dependencies: 206
-- Data for Name: equipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.equipo (idequipo, nombreequipo, estadoequipo, numarticulosequipo, observacionequipo, numarticulosagregados) FROM stdin;
7	B12	DESACTIVADO	6		1
6	C12	ACTIVADO	4		4
\.


--
-- TOC entry 2909 (class 0 OID 16435)
-- Dependencies: 208
-- Data for Name: ficha; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ficha (numeroficha, idprograma, idambiente, fechainicio, fechafin, jornadaficha) FROM stdin;
1493990	9	8	11/11/2011	22/02/2022	TARDE
123	10	9	11/11/2011	12/02/2022	NOCHE
\.


--
-- TOC entry 2910 (class 0 OID 16438)
-- Dependencies: 209
-- Data for Name: novedad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.novedad (idnovedad, numdocumentousuario, usuarionovedad, numeroficha, fechanovedad, articulo, estado) FROM stdin;
27	123	ADMINISTRADOR	1493990	2018-10-29 16:49:52	16	t
28	111	INSTRUCTOR	1493990	2018-10-29 16:52:52	21	t
29	222	ESPECIAL	123	2018-10-29 16:56:33	20	t
\.


--
-- TOC entry 2912 (class 0 OID 16446)
-- Dependencies: 211
-- Data for Name: programa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.programa (idprograma, nombreprograma, duracionprograma, tipoprograma) FROM stdin;
9	ADSI	24 MESES	TECNÓLOGO
10	ADMINISTRACION	12 MESES	TÉCNICO
\.


--
-- TOC entry 2914 (class 0 OID 16451)
-- Dependencies: 213
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario (numdocumentousuario, idprograma, nombreusuario, contraseniausuario, rolusuario, fotousuario) FROM stdin;
123	\N	ADMINISTRADOR	c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec	ADMINISTRADOR	
111	9	INSTRUCTOR	fb131bc57a477c8c9d068f1ee5622ac304195a77164ccc2d75d82dfe1a727ba8d674ed87f96143b2b416aacefb555e3045c356faa23e6d21de72b85822e39fdd	INSTRUCTOR	vistas/img/usuarios/111/834.jpg
222	10	ESPECIAL	5f28f24f5520230fd1e66ea6ac649e9f9637515f516b2ef74fc90622b60f165eafca8f34db8471b85b9b4a2cdf72f75099ae0eb8860c4f339252261778d406eb	ESPECIAL	vistas/img/usuarios/222/484.png
\.


--
-- TOC entry 2930 (class 0 OID 0)
-- Dependencies: 197
-- Name: acta_responsabilidad_idacta_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.acta_responsabilidad_idacta_seq', 1, false);


--
-- TOC entry 2931 (class 0 OID 0)
-- Dependencies: 199
-- Name: ambiente_idambiente_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ambiente_idambiente_seq', 9, true);


--
-- TOC entry 2932 (class 0 OID 0)
-- Dependencies: 202
-- Name: articulo_idarticulo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.articulo_idarticulo_seq', 22, true);


--
-- TOC entry 2933 (class 0 OID 0)
-- Dependencies: 205
-- Name: categoria_idcategoria_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categoria_idcategoria_seq', 8, true);


--
-- TOC entry 2934 (class 0 OID 0)
-- Dependencies: 207
-- Name: equipo_idequipo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.equipo_idequipo_seq', 7, true);


--
-- TOC entry 2935 (class 0 OID 0)
-- Dependencies: 210
-- Name: novedad_idnovedad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.novedad_idnovedad_seq', 29, true);


--
-- TOC entry 2936 (class 0 OID 0)
-- Dependencies: 212
-- Name: programa_idprograma_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.programa_idprograma_seq', 10, true);


--
-- TOC entry 2735 (class 2606 OID 16465)
-- Name: acta_responsabilidad acta_responsabilidad_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acta_responsabilidad
    ADD CONSTRAINT acta_responsabilidad_pk PRIMARY KEY (idacta);


--
-- TOC entry 2739 (class 2606 OID 16467)
-- Name: ambiente ambiente_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ambiente
    ADD CONSTRAINT ambiente_pk PRIMARY KEY (idambiente);


--
-- TOC entry 2742 (class 2606 OID 16469)
-- Name: aprendiz aprendiz_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aprendiz
    ADD CONSTRAINT aprendiz_pk PRIMARY KEY (numdocumentoaprendiz);


--
-- TOC entry 2744 (class 2606 OID 16471)
-- Name: articulo articulo_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.articulo
    ADD CONSTRAINT articulo_pk PRIMARY KEY (idarticulo);


--
-- TOC entry 2747 (class 2606 OID 16473)
-- Name: articulonovedad articulonovedad_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.articulonovedad
    ADD CONSTRAINT articulonovedad_pk PRIMARY KEY (idarticulo, idnovedad);


--
-- TOC entry 2750 (class 2606 OID 16475)
-- Name: categoria categoria_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_pk PRIMARY KEY (idcategoria);


--
-- TOC entry 2752 (class 2606 OID 16477)
-- Name: equipo equipo_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.equipo
    ADD CONSTRAINT equipo_pk PRIMARY KEY (idequipo);


--
-- TOC entry 2754 (class 2606 OID 16479)
-- Name: ficha ficha_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ficha
    ADD CONSTRAINT ficha_pk PRIMARY KEY (numeroficha);


--
-- TOC entry 2757 (class 2606 OID 16481)
-- Name: novedad novedad_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.novedad
    ADD CONSTRAINT novedad_pk PRIMARY KEY (idnovedad);


--
-- TOC entry 2761 (class 2606 OID 16483)
-- Name: programa programa_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.programa
    ADD CONSTRAINT programa_pk PRIMARY KEY (idprograma);


--
-- TOC entry 2763 (class 2606 OID 16485)
-- Name: usuario usuario_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pk PRIMARY KEY (numdocumentousuario);


--
-- TOC entry 2755 (class 1259 OID 16486)
-- Name: idambiente; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idambiente ON public.ficha USING btree (idambiente);


--
-- TOC entry 2745 (class 1259 OID 16487)
-- Name: idcategoria; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idcategoria ON public.articulo USING btree (idcategoria);


--
-- TOC entry 2736 (class 1259 OID 16488)
-- Name: idequipo; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idequipo ON public.acta_responsabilidad USING btree (idequipo);


--
-- TOC entry 2748 (class 1259 OID 16489)
-- Name: idnovedad; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idnovedad ON public.articulonovedad USING btree (idnovedad);


--
-- TOC entry 2740 (class 1259 OID 16490)
-- Name: idprograma; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idprograma ON public.ambiente USING btree (idprograma);


--
-- TOC entry 2737 (class 1259 OID 16491)
-- Name: numdocumentoaprendiz; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX numdocumentoaprendiz ON public.acta_responsabilidad USING btree (numdocumentoaprendiz);


--
-- TOC entry 2758 (class 1259 OID 16492)
-- Name: numdocumentousuario; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX numdocumentousuario ON public.novedad USING btree (numdocumentousuario);


--
-- TOC entry 2759 (class 1259 OID 16493)
-- Name: numeroficha; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX numeroficha ON public.novedad USING btree (numeroficha);


--
-- TOC entry 2764 (class 2606 OID 16494)
-- Name: acta_responsabilidad acta_responsabilidad_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acta_responsabilidad
    ADD CONSTRAINT acta_responsabilidad_ibfk_1 FOREIGN KEY (numdocumentoaprendiz) REFERENCES public.aprendiz(numdocumentoaprendiz);


--
-- TOC entry 2765 (class 2606 OID 16499)
-- Name: acta_responsabilidad acta_responsabilidad_ibfk_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acta_responsabilidad
    ADD CONSTRAINT acta_responsabilidad_ibfk_2 FOREIGN KEY (idequipo) REFERENCES public.equipo(idequipo);


--
-- TOC entry 2766 (class 2606 OID 16504)
-- Name: ambiente ambiente_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ambiente
    ADD CONSTRAINT ambiente_ibfk_1 FOREIGN KEY (idprograma) REFERENCES public.programa(idprograma);


--
-- TOC entry 2767 (class 2606 OID 16509)
-- Name: aprendiz aprendiz_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aprendiz
    ADD CONSTRAINT aprendiz_ibfk_1 FOREIGN KEY (numeroficha) REFERENCES public.ficha(numeroficha);


--
-- TOC entry 2768 (class 2606 OID 16514)
-- Name: articulo articulo_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.articulo
    ADD CONSTRAINT articulo_ibfk_1 FOREIGN KEY (idambiente) REFERENCES public.ambiente(idambiente);


--
-- TOC entry 2769 (class 2606 OID 16519)
-- Name: articulo articulo_ibfk_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.articulo
    ADD CONSTRAINT articulo_ibfk_2 FOREIGN KEY (idequipo) REFERENCES public.equipo(idequipo);


--
-- TOC entry 2770 (class 2606 OID 16524)
-- Name: articulo articulo_ibfk_3; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.articulo
    ADD CONSTRAINT articulo_ibfk_3 FOREIGN KEY (idcategoria) REFERENCES public.categoria(idcategoria);


--
-- TOC entry 2771 (class 2606 OID 16529)
-- Name: articulonovedad articulonovedad_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.articulonovedad
    ADD CONSTRAINT articulonovedad_ibfk_1 FOREIGN KEY (idarticulo) REFERENCES public.articulo(idarticulo);


--
-- TOC entry 2772 (class 2606 OID 16534)
-- Name: articulonovedad articulonovedad_ibfk_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.articulonovedad
    ADD CONSTRAINT articulonovedad_ibfk_2 FOREIGN KEY (idnovedad) REFERENCES public.novedad(idnovedad);


--
-- TOC entry 2773 (class 2606 OID 16539)
-- Name: ficha ficha_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ficha
    ADD CONSTRAINT ficha_ibfk_1 FOREIGN KEY (idprograma) REFERENCES public.programa(idprograma);


--
-- TOC entry 2774 (class 2606 OID 16544)
-- Name: ficha ficha_ibfk_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ficha
    ADD CONSTRAINT ficha_ibfk_2 FOREIGN KEY (idambiente) REFERENCES public.ambiente(idambiente);


--
-- TOC entry 2775 (class 2606 OID 16549)
-- Name: usuario usuario_ibfk_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_ibfk_1 FOREIGN KEY (idprograma) REFERENCES public.programa(idprograma);


-- Completed on 2018-11-09 17:03:08

--
-- PostgreSQL database dump complete
--

