package com.proyecto.aplicacion;


import android.content.DialogInterface;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.WindowManager;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.proyecto.aplicacion.Modelo.ActasJson;
import com.proyecto.aplicacion.Modelo.Articulos;
import com.proyecto.aplicacion.Modelo.BuscarFichaJson;
import com.proyecto.aplicacion.Modelo.BuscarFichasActasJson;
import com.proyecto.aplicacion.Modelo.VerificarActas;

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


/**
 * A simple {@link Fragment} subclass.
 */
public class CrearActas extends Fragment {

    Button btnBuscarFicha;
    View view;
    RequestQueue queue;

    static SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.getDefault());
    static Date date = new Date();
    public static String fecha = dateFormat.format(date);
    ArrayList<VerificarActas> verificarActas;


    Gson gson = new Gson();

    public static ArrayList<String> equipos;

    Spinner spinnerTipoNovedad;
    public static ArrayList<Articulos> articulos = new ArrayList<>();

    public static String idArticulo;

    AlertDialog.Builder alerta;
    EditText txtNumficha;

    Spinner spinnerAprendices;
    Spinner spinnerEquipoActas;
    Button btnEnviarActas;
    int validacion;
    ImageButton buscarFicha;
    ArrayList<String> aprendices = new ArrayList<>();
    ProgressBar progressBar;

    public static ArrayList<BuscarFichasActasJson> buscarFichasActasJsons = new ArrayList<>();


    public CrearActas() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment

        view = inflater.inflate(R.layout.fragment_crear_actas, container, false);
        inicializar();
        getActivity().setTitle("");
        progressBar.setVisibility(View.INVISIBLE);
        buscarFicha.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                buscarFichaActas();
            }
        });

        btnEnviarActas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                EnviarActa();
            }
        });
        return view;
    }

    private void inicializar() {
        txtNumficha = view.findViewById(R.id.txtNumFichaActas);
        txtNumficha = view.findViewById(R.id.txtNumFichaActas);
        spinnerAprendices = view.findViewById(R.id.spinnerAprendices);
        spinnerEquipoActas = view.findViewById(R.id.spinnerEquipoActas);
        buscarFicha = view.findViewById(R.id.imageButton);
        btnEnviarActas = view.findViewById(R.id.btnEnviarActa);
        queue = Volley.newRequestQueue(getContext());
        verificarActas = new ArrayList<>();
        progressBar=view.findViewById(R.id.progresBarCrearActas);
    }

    public void buscarFichaActas() {

        progressBar.setVisibility(View.VISIBLE);
        getActivity().getWindow().setFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE,
                WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
        getActivity().getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        equipos = new ArrayList<>();
        alerta = new AlertDialog.Builder(getContext());
        queue = Volley.newRequestQueue(getContext());


        String numFicha = txtNumficha.getText().toString();
        String url = Constants.url+"fichaActas/" + numFicha;
        StringRequest requestActas = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                if (response.equals("[]")) {
                    progressBar.setVisibility(View.INVISIBLE);
                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                    alerta.setTitle("ERROR");
                    alerta.setMessage("La ficha ingresada no se encuentra registrada");
                    alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            dialog.cancel();
                        }
                    });
                    alerta.create();
                    alerta.show();
                    txtNumficha.setText("");
                } else {
                    Type type = new TypeToken<List<BuscarFichasActasJson>>() {
                    }.getType();
                    buscarFichasActasJsons = gson.fromJson(response, type);

                    if (Login.iniciarSesionJson.get(0).getIdprograma()==null) {
                        for (int i = 0; i < buscarFichasActasJsons.size(); i++) {


                                equipos.add(buscarFichasActasJsons.get(i).getIdequipo() + " - " + buscarFichasActasJsons.get(i).getNombreequipo());


                        }
                        progressBar.setVisibility(View.INVISIBLE);
                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                        cargarSpinnersActas();
                    } else if (Login.iniciarSesionJson.get(0).getIdprograma().equals(buscarFichasActasJsons.get(0).getIdprograma())) {

                        for (int i = 0; i < buscarFichasActasJsons.size(); i++) {
                            if (buscarFichasActasJsons.get(i).getIdequipo().equals("")) {

                            } else {

                                equipos.add(buscarFichasActasJsons.get(i).getIdequipo() + " - " + buscarFichasActasJsons.get(i).getNombreequipo());
                            }

                        }

                        progressBar.setVisibility(View.INVISIBLE);
                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                        cargarSpinnersActas();

                    } else {
                        progressBar.setVisibility(View.INVISIBLE);
                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                        alerta.setTitle("ERROR");
                        alerta.setMessage("Usted no se encuentra asociado al programa de esta ficha");
                        alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                ArrayList<String> arrayList= new ArrayList<>();

                                ArrayAdapter<CharSequence> adapter1 = new ArrayAdapter(getContext(), android.R.layout.simple_spinner_dropdown_item, arrayList);
                                spinnerEquipoActas.setAdapter(adapter1);
                                spinnerAprendices.setAdapter(adapter1);
                                txtNumficha.setText("");
                                dialog.cancel();
                            }
                        });
                        alerta.create();
                        alerta.show();
                    }


                }
            }
        }, new Response.ErrorListener()

        {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getContext(), "ERROR", Toast.LENGTH_SHORT).show();
                progressBar.setVisibility(View.INVISIBLE);
                getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

            }
        });
        queue.add(requestActas);
    }


    private void cargarSpinnersActas() {

        ArrayList<String> aprendices = new ArrayList<>();


        Set<String> hs = new HashSet<>();
        hs.addAll(equipos);
        equipos.clear();
        equipos.addAll(hs);


        ArrayAdapter<CharSequence> adapter1 = new ArrayAdapter(getContext(), android.R.layout.simple_spinner_dropdown_item, equipos);
        spinnerEquipoActas.setAdapter(adapter1);


        for (int i = 0; i < buscarFichasActasJsons.size(); i++) {

            aprendices.add(buscarFichasActasJsons.get(i).getNumdocumentoaprendiz() + " - " + buscarFichasActasJsons.get(i).getNombreaprendiz());
        }

        Set<String> hs1 = new HashSet<>();
        hs1.addAll(aprendices);
        aprendices.clear();
        aprendices.addAll(hs1);


        ArrayAdapter<CharSequence> adapter2 = new ArrayAdapter(getContext(), android.R.layout.simple_spinner_dropdown_item, aprendices);
        spinnerAprendices.setAdapter(adapter2);
    }

    public void EnviarActa() {


        alerta = new AlertDialog.Builder(getContext());
        alerta.setTitle("Confirmación");
        alerta.setMessage("¿Desea registrar ésta acta?");
        alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {

                validaActa();


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

    private void validaActa() {
        progressBar.setVisibility(View.VISIBLE);
        getActivity().getWindow().setFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE,
                WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
        getActivity().getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        validacion = 0;

        final String url = Constants.url+"verificarActasEquipo/" + spinnerEquipoActas.getSelectedItem().toString().split(" - ")[0];
        StringRequest verificarEquipo = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if (response.equals("[]")) {
                    String url = Constants.url+"verificarActasAprendiz/" + spinnerAprendices.getSelectedItem().toString().split(" - ")[0];
                    StringRequest verificarAprendiz = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            if (response.equals("[]")) {
                                validacion = 0;
                            } else {
                                validacion = 2;
                                Type type = new TypeToken<List<VerificarActas>>() {
                                }.getType();
                                verificarActas = gson.fromJson(response, type);
                            }
                            insertarActa();


                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                            progressBar.setVisibility(View.INVISIBLE);
                            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                        }
                    });
                    queue.add(verificarAprendiz);

                } else {
                    Type type = new TypeToken<List<VerificarActas>>() {
                    }.getType();
                    verificarActas = gson.fromJson(response, type);
                    validacion = 1;
                    insertarActa();
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
        queue.add(verificarEquipo);
    }

    public void insertarActa() {
        if (validacion == 1) {
            progressBar.setVisibility(View.INVISIBLE);
            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
            alerta.setTitle("ERROR");
            alerta.setMessage("El equipo ya se encuentra registrado a cargo de el(la) aprendiz: " + verificarActas.get(0).getNombreaprendiz());
            alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    dialog.cancel();
                }
            });
            alerta.create();
            alerta.show();
        } else if (validacion == 2) {
            progressBar.setVisibility(View.INVISIBLE);
            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
            alerta.setTitle("ERROR");
            alerta.setMessage("El aprendiz ya se encuentra registrado a cargo del equipo: " + verificarActas.get(0).getNombreequipo());
            alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    dialog.cancel();
                }
            });
            alerta.create();
            alerta.show();

        } else if (validacion == 0) {
            String url = Constants.url+"actas";

            StringRequest requestActas = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    progressBar.setVisibility(View.INVISIBLE);
                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
                    Toast.makeText(getContext(), "Acta Registrada Correctamente", Toast.LENGTH_SHORT).show();

                    String url = Constants.url+"loginActas/" + Login.iniciarSesionJson.get(0).getNumdocumentousuario();

                    final StringRequest actas = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {

                            Type type = new TypeToken<List<ActasJson>>() {
                            }.getType();
                            Login.actasJsons = gson.fromJson(response, type);

                            Toast.makeText(getContext(), "Lista de Actas actualizada correctamente", Toast.LENGTH_SHORT).show();



                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                            progressBar.setVisibility(View.INVISIBLE);
                            getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                        }
                    });
                    queue.add(actas);


                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                    progressBar.setVisibility(View.INVISIBLE);
                    getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

                }
            }) {
                @Override
                protected Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<>();
                    params.put("numdocumentoaprendiz", spinnerAprendices.getSelectedItem().toString().split(" - ")[0]);
                    params.put("idequipo", spinnerEquipoActas.getSelectedItem().toString().split(" - ")[0]);
                    params.put("numeroficha", txtNumficha.getText().toString());
                    params.put("fechaacta", fecha);
                    params.put("numdocumentoinstructor", Login.iniciarSesionJson.get(0).getNumdocumentousuario());

                    return params;
                }
            };


            queue.add(requestActas);
        }
    }


}
