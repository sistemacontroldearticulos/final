package com.proyecto.aplicacion;


import android.Manifest;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.*;
import android.graphics.drawable.ColorDrawable;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;

import android.os.Environment;
import android.os.StrictMode;
import android.provider.MediaStore;
import android.support.constraint.ConstraintLayout;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.text.Editable;
import android.util.Base64;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.Glide;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.proyecto.aplicacion.Adaptadores.AdapterVerArticulosNovedad;
import com.proyecto.aplicacion.Modelo.ArticuloNovedad;
import com.proyecto.aplicacion.Modelo.Articulos;
import com.proyecto.aplicacion.Modelo.BuscarFichaJson;
import com.proyecto.aplicacion.Modelo.BuscarFichasActasJson;
import com.proyecto.aplicacion.Modelo.IdNovedad;
import com.proyecto.aplicacion.Modelo.IniciarSesionJson;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.lang.reflect.Method;
import java.lang.reflect.Type;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Locale;
import java.util.Map;
import java.util.Set;

import static android.app.Activity.RESULT_OK;


/**
 * A simple {@link Fragment} subclass.
 */
public class CrearNovedad extends Fragment {

    View view;
    Button btnCrearNovedad;

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;
    private static final int MY_CAMERA_CODE = 100;
    private static final int RESULT_CAMERA = 1;
    private String mCurrentPhotoPath;
    ImageView imgNovedad;
    byte[] byteArray;


    Bitmap region;


    public static ArrayList<BuscarFichaJson> buscarFichaJsons = new ArrayList<>();
    RequestQueue queue;
    TextView txtNumeroFicha;
    AdapterVerArticulosNovedad adapterVerArticulosNovedad;
    RecyclerView recyclerArticulos;
    ConstraintLayout layoutArticulos;
    ArrayList<IdNovedad> idNovedad = new ArrayList<>();
    SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.getDefault());
    Date date = new Date();
    final String fecha = dateFormat.format(date);
    String[] idEquipo;
    ImageView btnBuscarFicha;
    ProgressBar progressBar;
    String encoded;
    Button btnVerArticulos;
    Button btnAgregarArticuloPopup;
    Button btnCerrarPopup;
    ImageButton btnCamaraPopup;


    boolean validacion;

    Gson gson = new Gson();
    public static Spinner spinnerEquipo;
    public static ArrayList<String> equipos;
    public static ArrayList<String> tipoNovedad = new ArrayList<>();
    public static ArrayList<String> articulosSpinner = new ArrayList<>();
    public static Spinner spinnerTipoNovedad;
    public static ArrayList<Articulos> articulos = new ArrayList<>();
    public static Spinner spinnerArticulos;
    public static String idArticulo;
    public static ArrayList<ArticuloNovedad> articuloNovedad = new ArrayList<>();
    AlertDialog.Builder alerta;
    EditText txtNumficha;
    Dialog dialog;
    String numFicha;
    ImageView agregarArticuloI;
    Button btnAgregarArticulo;
    Spinner spinnerAprendices;
    Spinner spinnerEquipoActas;
    Context context;
    int comprobacion = 0;
    public static String temp;

    public static ArrayList<BuscarFichasActasJson> buscarFichasActasJsons = new ArrayList<>();


    public CrearNovedad() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        getActivity().setTitle("");


        // Inflate the layout for this fragment


        view = inflater.inflate(R.layout.fragment_crear_novedad, container, false);
        context = getContext();

        inicializar();
        progressBar.setVisibility(View.INVISIBLE);


        btnCrearNovedad.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                crearNovedad();
            }
        });

        btnBuscarFicha.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                buscarFicha();
            }
        });
        agregarArticuloI.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                agregarArticulos();
            }
        });

        btnVerArticulos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                verArticulos();
            }
        });

        return view;

    }

    private void inicializar() {
        btnCrearNovedad = view.findViewById(R.id.btnAgregar);
        equipos = new ArrayList<>();
        alerta = new AlertDialog.Builder(context);
        queue = Volley.newRequestQueue(context);
        txtNumeroFicha = view.findViewById(R.id.txtNumFichaActas);
        agregarArticuloI = view.findViewById(R.id.agregarArticulo);
        btnVerArticulos = view.findViewById(R.id.btnVerArticulos);

        spinnerTipoNovedad = view.findViewById(R.id.spinnerTipoNovedad);
        spinnerArticulos = view.findViewById(R.id.spinnerArticulo);
        idEquipo = new String[1];
        btnBuscarFicha = view.findViewById(R.id.imageView);
        progressBar = view.findViewById(R.id.progresBarCearNovedad);


        spinnerEquipo = view.findViewById(R.id.spinnerEquipoActas);

    }

    private void crearNovedad() {

        progressBar.setVisibility(View.VISIBLE);
        getActivity().getWindow().setFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE,
                WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
        getActivity().getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        validacion = false;


        if (articuloNovedad.size() == 0) {
            progressBar.setVisibility(View.INVISIBLE);
            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
            alerta.setTitle("Error");
            alerta.setMessage("No hay artículos registrados en la novedad");
            alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    dialog.cancel();
                }
            });
            alerta.create();
            alerta.show();
        } else {
            temp = String.valueOf(articuloNovedad.size());
            String alertaMensaje1 = "¿Desea registrar la novedad?";
            String alertaMensaje2 = "Artículos registrados: " + articuloNovedad.size();
            alerta.setTitle("Enviar Novedad");
            alerta.setMessage(alertaMensaje1 + "\n" + alertaMensaje2);
            alerta.setIcon(R.drawable.icono_usuario);
            alerta.setPositiveButton("Enviar", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {

                    String url = Constants.url + "crearNovedad";

                    StringRequest postRequest = new StringRequest(Request.Method.POST, url,
                            new Response.Listener<String>() {
                                @Override
                                public void onResponse(String response) {

                                    if(Login.iniciarSesionJson.get(0).getRolusuario().equals("ADMINISTRADOR"))
                                    {

                                        String url = Constants.url + "idNovedad";
                                        StringRequest request = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                                            @Override
                                            public void onResponse(String response) {

                                                Type type = new TypeToken<List<IdNovedad>>() {
                                                }.getType();
                                                idNovedad = gson.fromJson(response, type);

                                                for (int i = 0; i < articuloNovedad.size(); i++) {
                                                    String url = Constants.url + "articuloNovedad";

                                                    final int finalI = i;

                                                    StringRequest strRequest = new StringRequest(Request.Method.POST, url,
                                                            new Response.Listener<String>() {
                                                                @Override
                                                                public void onResponse(String response) {

                                                                    if (finalI == articuloNovedad.size() - 1) {
                                                                        Toast.makeText(getContext(), "Novedad Registrada Correctamente", Toast.LENGTH_SHORT).show();

                                                                        String url1 = Constants.url + "login/" + Login.numDocumento + "&" + Login.encriptar(Login.contras);


                                                                        StringRequest stringRequest = new StringRequest(Request.Method.GET, url1,
                                                                                new Response.Listener<String>() {
                                                                                    @Override
                                                                                    public void onResponse(String response) {


                                                                                        Type type = new TypeToken<List<IniciarSesionJson>>() {
                                                                                        }.getType();
                                                                                        Login.iniciarSesionJson = gson.fromJson(response, type);
                                                                                        articuloNovedad.clear();

                                                                                        Toast.makeText(getContext(), "Lista de Novedades Actualizada Correctamente", Toast.LENGTH_SHORT).show();
                                                                                        progressBar.setVisibility(View.INVISIBLE);
                                                                                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);


                                                                                    }
                                                                                }, new Response.ErrorListener() {
                                                                            @Override
                                                                            public void onErrorResponse(VolleyError error) {

                                                                                Toast.makeText(getContext(), "ERROR", Toast.LENGTH_SHORT).show();
                                                                                progressBar.setVisibility(View.INVISIBLE);
                                                                                getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                                                                            }
                                                                        });
                                                                        queue.add(stringRequest);
                                                                    }


                                                                }


                                                            },
                                                            new Response.ErrorListener() {
                                                                @Override
                                                                public void onErrorResponse(VolleyError error) {
                                                                    Toast.makeText(getContext(), error.toString(), Toast.LENGTH_SHORT).show();
                                                                    progressBar.setVisibility(View.INVISIBLE);
                                                                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                                                                }
                                                            }) {
                                                        @Override
                                                        protected Map<String, String> getParams() {
                                                            Map<String, String> params = new HashMap<String, String>();
                                                            params.put("idarticulo", articuloNovedad.get(finalI).getIdartculo());
                                                            params.put("idnovedad", idNovedad.get(0).getMax());
                                                            params.put("tiponovedad", articuloNovedad.get(finalI).getTiponovedad());
                                                            params.put("observacionnovedad", articuloNovedad.get(finalI).getObservacionnovedad().toString());
                                                            if (articuloNovedad.get(finalI).getImagen() == null) {
                                                                params.put("fotonovedad", "");
                                                            } else {
                                                                params.put("fotonovedad", articuloNovedad.get(finalI).getImagen());
                                                            }

                                                            return params;
                                                        }
                                                    };


                                                    queue.add(strRequest);


                                                }
                                            }
                                        }, new Response.ErrorListener() {
                                            @Override
                                            public void onErrorResponse(VolleyError error) {
                                                Toast.makeText(getContext(), "ERROR", Toast.LENGTH_SHORT).show();
                                                progressBar.setVisibility(View.INVISIBLE);
                                                getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                                            }
                                        });
                                        queue.add(request);
                                    }
                                    else
                                    {
                                        String url= Constants.url+"notificacion";
                                        StringRequest requestNotif = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
                                            @Override
                                            public void onResponse(String response) {
                                                String url = Constants.url + "idNovedad";
                                                StringRequest request = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                                                    @Override
                                                    public void onResponse(String response) {

                                                        Type type = new TypeToken<List<IdNovedad>>() {
                                                        }.getType();
                                                        idNovedad = gson.fromJson(response, type);

                                                        for (int i = 0; i < articuloNovedad.size(); i++) {
                                                            String url = Constants.url + "articuloNovedad";

                                                            final int finalI = i;

                                                            StringRequest strRequest = new StringRequest(Request.Method.POST, url,
                                                                    new Response.Listener<String>() {
                                                                        @Override
                                                                        public void onResponse(String response) {

                                                                            if (finalI == articuloNovedad.size() - 1) {
                                                                                Toast.makeText(getContext(), "Novedad Registrada Correctamente", Toast.LENGTH_SHORT).show();

                                                                                String url1 = Constants.url + "login/" + Login.numDocumento + "&" + Login.encriptar(Login.contras);


                                                                                StringRequest stringRequest = new StringRequest(Request.Method.GET, url1,
                                                                                        new Response.Listener<String>() {
                                                                                            @Override
                                                                                            public void onResponse(String response) {


                                                                                                Type type = new TypeToken<List<IniciarSesionJson>>() {
                                                                                                }.getType();
                                                                                                Login.iniciarSesionJson = gson.fromJson(response, type);
                                                                                                articuloNovedad.clear();

                                                                                                Toast.makeText(getContext(), "Lista de Novedades Actualizada Correctamente", Toast.LENGTH_SHORT).show();
                                                                                                progressBar.setVisibility(View.INVISIBLE);
                                                                                                getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);


                                                                                            }
                                                                                        }, new Response.ErrorListener() {
                                                                                    @Override
                                                                                    public void onErrorResponse(VolleyError error) {

                                                                                        Toast.makeText(getContext(), "ERROR", Toast.LENGTH_SHORT).show();
                                                                                        progressBar.setVisibility(View.INVISIBLE);
                                                                                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                                                                                    }
                                                                                });
                                                                                queue.add(stringRequest);
                                                                            }


                                                                        }


                                                                    },
                                                                    new Response.ErrorListener() {
                                                                        @Override
                                                                        public void onErrorResponse(VolleyError error) {
                                                                            Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                                                                            progressBar.setVisibility(View.INVISIBLE);
                                                                            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                                                                        }
                                                                    }) {
                                                                @Override
                                                                protected Map<String, String> getParams() {
                                                                    Map<String, String> params = new HashMap<String, String>();
                                                                    params.put("idarticulo", articuloNovedad.get(finalI).getIdartculo());
                                                                    params.put("idnovedad", idNovedad.get(0).getMax());
                                                                    params.put("tiponovedad", articuloNovedad.get(finalI).getTiponovedad());
                                                                    params.put("observacionnovedad", articuloNovedad.get(finalI).getObservacionnovedad().toString());
                                                                    if (articuloNovedad.get(finalI).getImagen() == null) {
                                                                        params.put("fotonovedad", null);
                                                                    } else {
                                                                        params.put("fotonovedad", articuloNovedad.get(finalI).getImagen());
                                                                    }

                                                                    return params;
                                                                }
                                                            };


                                                            queue.add(strRequest);


                                                        }
                                                    }
                                                }, new Response.ErrorListener() {
                                                    @Override
                                                    public void onErrorResponse(VolleyError error) {
                                                        Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                                                        progressBar.setVisibility(View.INVISIBLE);
                                                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                                                    }
                                                });
                                                queue.add(request);

                                            }
                                        }, new Response.ErrorListener() {
                                            @Override
                                            public void onErrorResponse(VolleyError error) {
                                                Toast.makeText(getContext(), "ERROR", Toast.LENGTH_SHORT).show();

                                            }
                                        }) {
                                            @Override
                                            protected Map<String, String> getParams() {
                                                Map<String, String> params = new HashMap<String, String>();
                                                params.put("numdocumentousuario", Login.iniciarSesionJson.get(0).getNumdocumentousuario());
                                                params.put("tipo", "CREADO UNA NUEVA NOVEDAD");
                                                params.put("fecha", fecha);
                                                params.put("leido", "0");


                                                return params;
                                            }
                                        };
                                        queue.add(requestNotif);
                                    }
                                            // response




                                }

                            },
                            new Response.ErrorListener() {
                                @Override
                                public void onErrorResponse(VolleyError error) {
                                    // error
                                    Toast.makeText(getContext(), error.toString(), Toast.LENGTH_SHORT).show();
                                    progressBar.setVisibility(View.INVISIBLE);
                                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                                }
                            }
                    ) {
                        @Override
                        protected Map<String, String> getParams() {
                            Map<String, String> params = new HashMap<String, String>();
                            params.put("numdocumentousuario", Login.iniciarSesionJson.get(0).getNumdocumentousuario());
                            params.put("numeroficha", txtNumeroFicha.getText().toString());
                            params.put("fechanovedad", fecha);
                            params.put("articulo", articuloNovedad.get(0).getIdartculo());
                            params.put("estado", "1");


                            return params;
                        }
                    };
                    queue.add(postRequest);


                }


            });
            alerta.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    progressBar.setVisibility(View.INVISIBLE);
                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                    dialog.cancel();
                }
            });
            alerta.create();
            alerta.show();


        }


    }


    public void buscarFicha() {
        progressBar.setVisibility(View.VISIBLE);
        getActivity().getWindow().setFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE,
                WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
        getActivity().getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));


        numFicha = txtNumeroFicha.getText().toString();


        articulos.clear();
        tipoNovedad.clear();
        articulosSpinner.clear();
        equipos.clear();


        //====================//
        //  CARGAR SPINNERS  //
        //==================//

        if (Login.iniciarSesionJson.get(0).getIdprograma() == null) {

            if (numFicha.equals("")) {
                txtNumeroFicha.setError("Debe ingresar un número de ficha");
                progressBar.setVisibility(View.INVISIBLE);
                getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
            } else {

                String url = Constants.url + "ficha/" + numFicha;

                StringRequest stringRequest = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        if (response.equals("[]")) {
                            progressBar.setVisibility(View.INVISIBLE);
                            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                            alerta.setTitle("BUSCAR FICHA");
                            alerta.setMessage("La ficha que ingresó no se encuentra registrada");
                            alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {

                                    txtNumeroFicha.setText("");
                                    ArrayAdapter<CharSequence> adapter1 = new ArrayAdapter(getContext(), android.R.layout.simple_spinner_dropdown_item, tipoNovedad);
                                    spinnerTipoNovedad.setAdapter(adapter1);
                                    spinnerEquipo.setAdapter(adapter1);
                                    spinnerArticulos.setAdapter(adapter1);


                                    dialog.cancel();

                                }

                            });
                            alerta.create();
                            alerta.show();

                        } else {

                            Type type = new TypeToken<List<BuscarFichaJson>>() {
                            }.getType();
                            buscarFichaJsons = gson.fromJson(response, type);

                            for (int i = 0; i < buscarFichaJsons.size(); i++) {
                                if (buscarFichaJsons.get(i).getIdequipo().equals("")) {
                                    equipos.add(0, "Sin Equipo");
                                } else {

                                    equipos.add(buscarFichaJsons.get(i).getIdequipo() + " - " + buscarFichaJsons.get(i).getNombreequipo());
                                }

                            }

                            progressBar.setVisibility(View.INVISIBLE);
                            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                            cargarSpinners();


                        }

                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                        progressBar.setVisibility(View.INVISIBLE);
                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                    }
                });
                queue.add(stringRequest);
            }
        } else {
            String url = Constants.url + "ficha/" + numFicha;

            StringRequest stringRequest = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    if (response.equals("[]")) {
                        progressBar.setVisibility(View.INVISIBLE);
                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                        alerta.setTitle("BUSCAR FICHA");
                        alerta.setMessage("La ficha que ingresó no se encuentra registrada");
                        alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {

                                txtNumeroFicha.setText("");
                                ArrayAdapter<CharSequence> adapter1 = new ArrayAdapter(getContext(), android.R.layout.simple_spinner_dropdown_item, tipoNovedad);
                                spinnerTipoNovedad.setAdapter(adapter1);
                                spinnerEquipo.setAdapter(adapter1);
                                spinnerArticulos.setAdapter(adapter1);


                                dialog.cancel();

                            }

                        });
                        alerta.create();
                        alerta.show();

                    } else {

                        Type type = new TypeToken<List<BuscarFichaJson>>() {
                        }.getType();
                        buscarFichaJsons = gson.fromJson(response, type);


                        if (buscarFichaJsons.get(0).getIdprograma().equals(Login.iniciarSesionJson.get(0).getIdprograma())) {
                            for (int i = 0; i < buscarFichaJsons.size(); i++) {
                                if (buscarFichaJsons.get(i).getIdequipo().equals("")) {
                                    equipos.add(0, "Sin Equipo");
                                } else {

                                    equipos.add(buscarFichaJsons.get(i).getIdequipo() + " - " + buscarFichaJsons.get(i).getNombreequipo());

                                }

                            }

                            progressBar.setVisibility(View.INVISIBLE);
                            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                            cargarSpinners();
                        } else {
                            progressBar.setVisibility(View.INVISIBLE);
                            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                            alerta.setTitle("ERROR");
                            alerta.setMessage("Usted no se encuentra registrado a este programa");
                            alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {
                                    dialog.cancel();
                                }
                            });
                            alerta.create();
                            alerta.show();
                        }


                    }

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                    progressBar.setVisibility(View.INVISIBLE);
                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                }
            });
            queue.add(stringRequest);
        }


    }


    private void cargarSpinners() {


        Set<String> hs = new HashSet<>();
        hs.addAll(equipos);
        equipos.clear();
        equipos.addAll(hs);
        articulos.clear();

        ArrayAdapter<CharSequence> adapter1 = new ArrayAdapter(getContext(), android.R.layout.simple_spinner_dropdown_item, equipos);
        spinnerEquipo.setAdapter(adapter1);

        spinnerEquipo.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                articulos.clear();
                articulosSpinner.clear();

                String idEquipo = parent.getItemAtPosition(position).toString().split(" - ")[0];
                if (idEquipo.equals("Sin Equipo")) {
                    idEquipo = "";
                }
                for (int i = 0; i < buscarFichaJsons.size(); i++) {

                    if (buscarFichaJsons.get(i).getIdequipo().equals(idEquipo)) {
                        Articulos articulos1 = new Articulos();
                        articulos1.setIdarticulo(buscarFichaJsons.get(i).getIdarticulo());
                        articulos1.setTipoarticulo(buscarFichaJsons.get(i).getTipoarticulo());
                        articulos1.setIdequipo(buscarFichaJsons.get(i).getIdequipo());

                        articulos.add(articulos1);
                        articulosSpinner.add(buscarFichaJsons.get(i).getIdarticulo() + " - " + buscarFichaJsons.get(i).getTipoarticulo());


                    }
                }
                ArrayAdapter<CharSequence> adapter2 = new ArrayAdapter(getContext(), android.R.layout.simple_spinner_dropdown_item, articulosSpinner);
                spinnerArticulos.setAdapter(adapter2);

                spinnerArticulos.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                    @Override
                    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

                    }

                    @Override
                    public void onNothingSelected(AdapterView<?> parent) {

                    }
                });
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });


        tipoNovedad.add("Tipo Novedad");
        tipoNovedad.add("DAÑADO");
        tipoNovedad.add("PERDIDO");

        ArrayAdapter<CharSequence> adapter = new ArrayAdapter(getContext(), android.R.layout.simple_spinner_dropdown_item, tipoNovedad);
        spinnerTipoNovedad.setAdapter(adapter);

        spinnerTipoNovedad.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });

    }

    public void agregarArticulos() {
        encoded = "";
        if (spinnerTipoNovedad.getSelectedItem().toString().equals("Tipo Novedad")) {
            TextView errorText = (TextView) spinnerTipoNovedad.getSelectedView();
            errorText.setError("Debe seleccionar un tipo de novedad");
        } else {

            dialog = new Dialog(getContext());


            progressBar.setVisibility(View.VISIBLE);


            String url = Constants.url + "buscarArticulo/" + spinnerArticulos.getSelectedItem().toString().split("-")[0];
            ;
            StringRequest buscarArticulo = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    if (!response.equals("[]")) {

                        progressBar.setVisibility(View.INVISIBLE);
                        dialog.getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                        alerta.setTitle("ERROR");
                        alerta.setMessage("El artículo seleccionado ya se encuentra reportado");
                        alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                dialog.cancel();
                            }
                        });
                        alerta.create();

                        alerta.show();
                    } else {


                        dialog.setContentView(R.layout.activity_descripcion_novedad);
                        dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                        final EditText txtDescripcion = dialog.findViewById(R.id.txtDescripcion);

                        imgNovedad = dialog.findViewById(R.id.imagenNovedad);

                        btnAgregarArticuloPopup = dialog.findViewById(R.id.btnAgregar);
                        btnCerrarPopup = dialog.findViewById(R.id.btnCancelar);
                        btnCamaraPopup = dialog.findViewById(R.id.btnCamara);


                        progressBar.setVisibility(View.INVISIBLE);
                        alerta.setTitle("Confirmación");
                        alerta.setMessage("¿Desea agregar éste artículo a la novedad?");
                        alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog1, int which) {
                                idArticulo = spinnerArticulos.getSelectedItem().toString().split("-")[0];
                                //startActivity(new Intent(MainActivity.this, DescripcionNovedad.class));


                                final boolean[] bandera = {false};
                                final ArticuloNovedad articuloNovedad1 = new ArticuloNovedad();


                                btnAgregarArticuloPopup.setOnClickListener(new View.OnClickListener() {
                                    @Override
                                    public void onClick(View v) {
                                        if (articuloNovedad.size() == 0) {
                                            Editable descripcion = txtDescripcion.getText();
                                            articuloNovedad1.setIdartculo(idArticulo);
                                            articuloNovedad1.setIdnovedad(null);
                                            articuloNovedad1.setObservacionnovedad(descripcion);
                                            articuloNovedad1.setTiponovedad(spinnerTipoNovedad.getSelectedItem().toString());
                                            articuloNovedad1.setImagen(encoded);
                                            if (spinnerEquipo.getSelectedItem().toString().equals("Sin Equipo")) {
                                                idEquipo[0] = "";

                                            } else {
                                                idEquipo[0] = spinnerEquipo.getSelectedItem().toString().split(" - ")[0];
                                            }

                                            articuloNovedad1.setIdequipo(idEquipo[0]);
                                            articuloNovedad1.setTipoarticulo(spinnerArticulos.getSelectedItem().toString().split(" - ")[1]);

                                            articuloNovedad.add(articuloNovedad1);
                                            dialog.dismiss();

                                            Toast.makeText(getContext(), "Artículo agregado correctamente", Toast.LENGTH_SHORT).show();

                                        } else {

                                            for (int i = 0; i < articuloNovedad.size(); i++) {
                                                if (articuloNovedad.get(i).getIdartculo().equals(idArticulo)) {
                                                    bandera[0] = true;
                                                    i = 9999999;
                                                    alerta.setTitle("Error");
                                                    alerta.setMessage("El artículo seleccionado ya se encuentra agregado a la novedad");
                                                    alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                                                        @Override
                                                        public void onClick(DialogInterface dialog1, int which) {


                                                            dialog1.cancel();
                                                        }
                                                    });

                                                    dialog.dismiss();
                                                    alerta.create();
                                                    alerta.show();


                                                }

                                            }

                                            if (bandera[0] == false) {


                                                Editable descripcion = txtDescripcion.getText();
                                                articuloNovedad1.setIdartculo(idArticulo);
                                                articuloNovedad1.setIdnovedad(null);
                                                articuloNovedad1.setObservacionnovedad(descripcion);
                                                articuloNovedad1.setTiponovedad(spinnerTipoNovedad.getSelectedItem().toString());
                                                articuloNovedad1.setImagen(encoded);

                                                if (spinnerEquipo.getSelectedItem().toString().equals("Sin Equipo")) {
                                                    idEquipo[0] = "";

                                                } else {
                                                    idEquipo[0] = spinnerEquipo.getSelectedItem().toString().split(" - ")[0];
                                                }

                                                articuloNovedad1.setIdequipo(idEquipo[0]);
                                                articuloNovedad1.setTipoarticulo(spinnerArticulos.getSelectedItem().toString().split("-")[1]);
                                                articuloNovedad.add(articuloNovedad1);
                                                bandera[0] = false;
                                                dialog.dismiss();
                                                dialog.dismiss();
                                                Toast.makeText(getContext(), "Artículo agregado correctamente", Toast.LENGTH_SHORT).show();


                                            }
                                            bandera[0] = false;
                                        }
                                    }
                                });


                                btnCerrarPopup.setOnClickListener(new View.OnClickListener() {
                                    @Override
                                    public void onClick(View v) {
                                        progressBar.setVisibility(View.INVISIBLE);
                                        dialog.cancel();
                                    }
                                });

                                btnCamaraPopup.setOnClickListener(new View.OnClickListener() {
                                    @Override
                                    public void onClick(View v) {


                                        if (Build.VERSION.SDK_INT >= 24) {
                                            try {
                                                Method m = StrictMode.class.getMethod("disableDeathOnFileUriExposure");
                                                m.invoke(null);
                                                takephoto();

                                            } catch (Exception e) {

                                            }
                                        }


                                    }
                                });
                                dialog.show();

                            }


                        });

                        alerta.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                dialog.cancel();

                            }
                        });

                        alerta.show();


                    }


                }


            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                    progressBar.setVisibility(View.INVISIBLE);
                    dialog.getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                }

            });
            queue.add(buscarArticulo);
        }


    }


    private void takephoto() {
        if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.LOLLIPOP) {
            if (ActivityCompat.checkSelfPermission(getContext(), Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED &&
                    ActivityCompat.checkSelfPermission(getContext(), Manifest.permission.WRITE_EXTERNAL_STORAGE) != PackageManager.PERMISSION_GRANTED) {
                requestPermissions(new String[]{Manifest.permission.CAMERA, Manifest.permission.WRITE_EXTERNAL_STORAGE}, MY_CAMERA_CODE);

            }
        }


        intentCamera();
    }

    private void intentCamera() {
        final Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        if (intent.resolveActivity(getActivity().getPackageManager()) != null) {
            File file = null;
            try {

                file = createImageFile();

            } catch (IOException e) {

            }
            if (file != null) {
                intent.putExtra(MediaStore.EXTRA_OUTPUT, Uri.fromFile(file));
                alerta.setTitle("Información");
                alerta.setMessage("Se recomienda tomar la foto de manera horizontal");
                alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.cancel();
                        startActivityForResult(intent, RESULT_CAMERA);
                    }
                });
                alerta.create();
                alerta.show();

            }
        }
    }

    private File createImageFile() throws IOException {
        String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        String imageFileName = "JPEG_" + timeStamp + "_";
        File file = Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES);
        File image = File.createTempFile(imageFileName, ".jpg", file);
        mCurrentPhotoPath = image.getAbsolutePath();
        return image;
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == RESULT_CAMERA && resultCode == RESULT_OK) {
            Intent intent = new Intent();
            Uri uri = Uri.fromFile(new File(mCurrentPhotoPath));
            intent.setData(uri);
            this.getActivity().sendBroadcast(intent);
            loadphoto();
        }
    }

    private void loadphoto() {


        Uri uri = Uri.fromFile(new File(mCurrentPhotoPath));
        convertir(uri);


        Glide.with(this).load(uri).into(imgNovedad);


    }

    private String convertir(Uri uri) {


        try {
            region = MediaStore.Images.Media.getBitmap(context.getContentResolver(), uri);


            int origWidth = region.getWidth();
            int origHeight = region.getHeight();

            final int destWidth = 1000;//or the width you need

            if (origWidth > destWidth) {
                // picture is wider than we want it, we calculate its target height
                int destHeight = origHeight / (origWidth / destWidth);
                // we create an scaled bitmap so it reduces the image, not just trim it
                Bitmap b2 = Bitmap.createScaledBitmap(region, destWidth, destHeight, false);

                ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
                b2.compress(Bitmap.CompressFormat.JPEG, 40, byteArrayOutputStream);
                byteArray = byteArrayOutputStream.toByteArray();
                encoded = Base64.encodeToString(byteArray, Base64.DEFAULT);

            }
        } catch (IOException e) {
            e.printStackTrace();
        }


        return encoded;

    }


    public void verArticulos() {


        adapterVerArticulosNovedad = new AdapterVerArticulosNovedad(articuloNovedad);

        final Dialog dialog = new Dialog(getContext());
        dialog.setContentView(R.layout.popup_novedades);
        layoutArticulos = dialog.findViewById(R.id.layoutNovedades);
        layoutArticulos.getLayoutParams().width = 840;
        layoutArticulos.requestLayout();
        TextView jornada = dialog.findViewById(R.id.txtJornada);
        jornada.setText("OBSERVACIÓN");
        jornada.setVisibility(View.GONE);

        jornada.setTextSize(11);
        dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.WHITE));

        ++++++++++++++++++++++++


        recyclerArticulos = dialog.findViewById(R.id.recyclerViewArticulos);
        recyclerArticulos.setLayoutManager(new LinearLayoutManager(dialog.getContext(), LinearLayoutManager.VERTICAL, false));
        recyclerArticulos.setHasFixedSize(true);

        recyclerArticulos.setAdapter(adapterVerArticulosNovedad);


        dialog.setCancelable(true);
        dialog.show();

        adapterVerArticulosNovedad.setMlistener(new AdapterVerArticulosNovedad.OnClickListener() {
            @Override
            public void itemClick(final int position, View itemView) {
                alerta.setTitle("Confirmación");
                alerta.setMessage("¿Desea eliminar este artículo de la novedad?");
                alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {

                    @Override
                    public void onClick(DialogInterface dialog1, int which) {
                        String idArticuloSelected = articuloNovedad.get(position).getIdartculo();
                        for (int i = 0; i < articuloNovedad.size(); i++) {
                            if (articuloNovedad.get(i).getIdartculo().equals(idArticuloSelected)) {
                                articuloNovedad.remove(i);
                                dialog1.cancel();
                                dialog.cancel();
                                Toast.makeText(getContext(), "El artículo fue eliminado de la novedad", Toast.LENGTH_SHORT).show();
                            }

                        }
                    }
                });
                alerta.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.cancel();
                    }
                });
                alerta.create();
                alerta.show();
            }
        });

    }


}


