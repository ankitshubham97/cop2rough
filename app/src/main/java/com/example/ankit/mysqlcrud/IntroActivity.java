package com.example.ankit.mysqlcrud;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class IntroActivity extends AppCompatActivity {
    private EditText editTextLoginId;
    private EditText editTextPassword;

    private Button buttonLoginAdmin;
    private Button buttonLoginUser;

    Intent intent;

    public static final String MyPREFERENCES = "MyPrefs" ;
    public static final String Id = "idKey";
    public static final String Password = "passwordKey";
    SharedPreferences sharedpreferences;
    protected void loginuser(){
        final Context context = this;
        RequestQueue queue = Volley.newRequestQueue(this);
        String url=Config.URL_SERVER+"/rough/select_post_byid.php?id="+editTextLoginId.getText();
        JsonObjectRequest jsonObjReq = new JsonObjectRequest(Request.Method.POST,
                url, null, new Response.Listener<JSONObject>() {

            @Override
            public void onResponse(JSONObject response) {
                try {
                    // Parsing json object response
                    // response will be a json object
                    String password = response.getString("password");
                    String name = response.getString("name");
                    Toast.makeText(getApplicationContext(),"Welcome "+name+"!", Toast.LENGTH_SHORT).show();
                    if(password.equals(editTextPassword.getText().toString())){
                        intent = new Intent(context, LoginActivity.class);
                        startActivity(intent);
                    }
                    /*JSONObject phone = response.getJSONObject("phone");
                    String home = phone.getString("home");
                    String mobile = phone.getString("mobile");*/

                   /* jsonResponse = "";
                    jsonResponse += "Name: " + name + "\n\n";
                    jsonResponse += "Email: " + email + "\n\n";
                    jsonResponse += "Home: " + home + "\n\n";
                    jsonResponse += "Mobile: " + mobile + "\n\n";

                    txtResponse.setText(jsonResponse);*/


                } catch (JSONException e) {
                    e.printStackTrace();
                    Toast.makeText(getApplicationContext(),
                            "Error: " + e.getMessage(),
                            Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Login failed as user", Toast.LENGTH_SHORT).show();
                // hide the progress dialog
            }
        });
        queue.add(jsonObjReq);
    }

    protected void loginadmin(){
        final Context context = this;
        //editTextLoginId.setText("login");
        if(editTextLoginId.getText().toString().equals("admin") && editTextPassword.getText().toString().equals("admin") ){
            //session starts
            SharedPreferences.Editor editor = sharedpreferences.edit();

            editor.putString(Id, editTextLoginId.getText().toString());
            editor.putString(Password, editTextPassword.getText().toString());
            editor.commit();
            intent = new Intent(context, MainActivity.class);
            startActivity(intent);
        }
        else{
            Toast.makeText(IntroActivity.this, "Login failed", Toast.LENGTH_LONG).show();
        }
    } 
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_intro);

        editTextLoginId = (EditText) findViewById(R.id.editTextLoginId);
        editTextPassword = (EditText) findViewById(R.id.editTextPassword);
        buttonLoginAdmin = (Button) findViewById(R.id.buttonLoginAdmin);
        buttonLoginUser = (Button) findViewById(R.id.buttonLoginUser);


        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_PRIVATE);

        buttonLoginAdmin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loginadmin();
            }
        });
        buttonLoginUser.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loginuser();
            }
        });
    }
}
