--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

--
-- Name: articles_id_ar_seq; Type: SEQUENCE SET; Schema: public; Owner: etudiant1
--

SELECT pg_catalog.setval('articles_id_ar_seq', 6, true);


--
-- Name: clients_id_cl_seq; Type: SEQUENCE SET; Schema: public; Owner: etudiant1
--

SELECT pg_catalog.setval('clients_id_cl_seq', 4, true);


--
-- Name: commandes_id_co_seq; Type: SEQUENCE SET; Schema: public; Owner: etudiant1
--

SELECT pg_catalog.setval('commandes_id_co_seq', 4, true);


--
-- Name: depences_id_dep_seq; Type: SEQUENCE SET; Schema: public; Owner: etudiant1
--

SELECT pg_catalog.setval('depences_id_dep_seq', 2, true);


--
-- Name: employer_id_em_seq; Type: SEQUENCE SET; Schema: public; Owner: etudiant1
--

SELECT pg_catalog.setval('employer_id_em_seq', 3, true);


--
-- Name: facture_id_fac_seq; Type: SEQUENCE SET; Schema: public; Owner: etudiant1
--

SELECT pg_catalog.setval('facture_id_fac_seq', 1, false);


--
-- Name: fournisseur_id_fo_seq; Type: SEQUENCE SET; Schema: public; Owner: etudiant1
--

SELECT pg_catalog.setval('fournisseur_id_fo_seq', 3, true);


--
-- Data for Name: fournisseur; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY fournisseur (id_fo, nom_fo, add_fo, tel1_fo, tel2_fo) FROM stdin;
1	S.O.D.O.U.F	Yirimadjo, face l'ancien poste	20 23 34 45	65 34 78 89
2	S.O.Y.A.T	Yirimadjo, face l'ancien poste	20 23 34 45	65 34 78 89
3	im.id.sac	Yirimadjo, face l'ancien poste	20 23 34 45	65 34 78 89
\.


--
-- Data for Name: articles; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY articles (id_ar, lib_ar, type_ar, stoc_ar, vente_ar, id_fo, prix_achat, prix_vente) FROM stdin;
2	FER ROND 9.5	F10	30	0	2	2800	3500
1	DOUBLE ZZ BLANC	ZZX09	50	0	2	4250	4500
3	LAME Francais 6/10	L6/10	20	0	2	2900	3750
4	LAME Francais 7/10	L7/10	20	0	2	3100	4000
5	imidsac	imid	4	1	1	300	400
6	yyyy	et6	30	0	3	345	500
\.


--
-- Data for Name: achat; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY achat (a_date, id_ar, qt_ar, pu_ar, debit, credit, solde, annee, mois) FROM stdin;
2011-07-12	3	34	2900	50000	77500	127500	2011	1
\.


--
-- Data for Name: bamk; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY bamk (compte_banc, nom_banc, type, date_b, somme, solde) FROM stdin;
30502006001-52	B.D.M	v	2011-01-12	500000	10000000
\.


--
-- Data for Name: benefices; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY benefices (annee, mois, id_ar, achat, vente, benefice) FROM stdin;
2011	1	2	0	0	0
2011	2	2	0	0	0
2011	3	2	0	0	0
2011	4	2	0	0	0
2011	5	2	0	0	0
2011	6	2	0	0	0
2011	7	2	0	0	0
2011	8	2	0	0	0
2011	9	2	0	0	0
2011	10	2	0	0	0
2011	11	2	0	0	0
2011	12	2	0	0	0
2011	1	1	0	0	0
2011	2	1	0	0	0
2011	3	1	0	0	0
2011	4	1	0	0	0
2011	5	1	0	0	0
2011	6	1	0	0	0
2011	7	1	0	0	0
2011	8	1	0	0	0
2011	9	1	0	0	0
2011	10	1	0	0	0
2011	11	1	0	0	0
2011	12	1	0	0	0
2011	1	3	0	0	0
2011	2	3	0	0	0
2011	3	3	0	0	0
2011	4	3	0	0	0
2011	5	3	0	0	0
2011	6	3	0	0	0
2011	7	3	0	0	0
2011	8	3	0	0	0
2011	9	3	0	0	0
2011	10	3	0	0	0
2011	11	3	0	0	0
2011	12	3	0	0	0
2011	1	4	0	0	0
2011	2	4	0	0	0
2011	3	4	0	0	0
2011	4	4	0	0	0
2011	5	4	0	0	0
2011	6	4	0	0	0
2011	7	4	0	0	0
2011	8	4	0	0	0
2011	9	4	0	0	0
2011	10	4	0	0	0
2011	11	4	0	0	0
2011	12	4	0	0	0
2011	1	5	0	0	0
2011	2	5	0	0	0
2011	3	5	0	0	0
2011	4	5	0	0	0
2011	5	5	0	0	0
2011	6	5	0	0	0
2011	7	5	0	0	0
2011	8	5	0	0	0
2011	9	5	0	0	0
2011	10	5	0	0	0
2011	11	5	0	0	0
2011	12	5	0	0	0
2011	1	6	0	0	0
2011	2	6	0	0	0
2011	3	6	0	0	0
2011	4	6	0	0	0
2011	5	6	0	0	0
2011	6	6	0	0	0
2011	7	6	0	0	0
2011	8	6	0	0	0
2011	9	6	0	0	0
2011	10	6	0	0	0
2011	11	6	0	0	0
2011	12	6	0	0	0
\.


--
-- Data for Name: benefices_total; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY benefices_total (annee, mois, depence, achat, vente, benefice) FROM stdin;
\.


--
-- Data for Name: clients; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY clients (id_cl, nom_cl, prenom_cl, add_cl, tel1_cl, tel2_cl) FROM stdin;
2	COULIBALY	Abdoul	Gorofina nord, Rue:23 Porte:123	66 65 35 65	76 12 93 85
3	KANTE	Amara	Bacodjikoroni, Rue:245 Porte:12	66 65 35 65	76 12 93 85
1	SACKO	Abdoulkader	Lafiabougou, Bougoudani, Rue:309 P:2	66 65 35 65	76 12 93 85
4	CISSE	Desse	Lafiabougou bougou	33 33 33 22	44 44 44 22
\.


--
-- Data for Name: commandes; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY commandes (id_co, id_cl, date1, date2, etat_co) FROM stdin;
1	1	2011-07-11	2011-09-10	n
2	1	2011-07-11	2011-09-11	n
3	2	2011-07-11	2011-09-21	n
4	2	2011-07-11	2011-09-29	n
\.


--
-- Data for Name: ccommandes; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY ccommandes (id_co, id_ar, qt_ar, pu_ar, total) FROM stdin;
\.


--
-- Data for Name: depences; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY depences (id_dep, lib_dep, date_dep, montant) FROM stdin;
1	Entretient de magazin	2011-07-11	7500
2	Quotisation	2011-07-11	2500
\.


--
-- Data for Name: employer; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY employer (id_em, nom_em, prenom_em, add_em, tel1_em, tel2_em, montant) FROM stdin;
3	TRAORE	Soumi	Hamdalaye, A.C.I 2000	33 44 55 66 	55 55 55 55	20000
2	TONKARA	Mambi	Sebenikoro R:456 - P:23	33 44 55 66 	66 66 66 66	25000
1	BAGAYOKO	Bourama	Djicoroni para	33 44 55 66 23	11 11 11 11	50000
\.


--
-- Data for Name: essai1; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY essai1 (n, m) FROM stdin;
4	5
\.


--
-- Data for Name: essai2; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY essai2 (a, b) FROM stdin;
4	5
\.


--
-- Data for Name: facture; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY facture (id_fac, date_fac, client, somme) FROM stdin;
\.


--
-- Data for Name: facture_con; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY facture_con (id_fac, id_ar, qte_ar, montant) FROM stdin;
\.


--
-- Data for Name: ventes; Type: TABLE DATA; Schema: public; Owner: etudiant1
--

COPY ventes (date_ve, id_ar, qt_ar, pu_ar, debit, credit, solde, annee, mois) FROM stdin;
2011-07-12	1	10	4500	45000	0	45000	2011	3
\.


--
-- PostgreSQL database dump complete
--

