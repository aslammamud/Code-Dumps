# Date and Time Picker

In `activity_main.xml` file code is:   
```xml
<LinearLayout
    android:layout_width="match_parent"
    android:layout_height="40dp"
    android:layout_margin="20dp"
    android:orientation="horizontal"
    android:gravity="center">

    <ImageView
        android:id="@+id/iconDate"
        android:layout_width="wrap_content"
        android:layout_height="30dp"
        android:layout_gravity="center"
        android:adjustViewBounds="true"
        android:scaleType="centerCrop"
        android:src="@drawable/calender" />

    <EditText
        android:id="@+id/selectDate"
        android:layout_width="wrap_content"
        android:layout_height="match_parent"
        android:layout_marginStart="5dp"
        android:gravity="center"
        android:hint="selcet any date" />


    <ImageView
        android:id="@+id/iconTime"
        android:layout_width="wrap_content"
        android:layout_height="30dp"
        android:layout_gravity="center"
        android:adjustViewBounds="true"
        android:scaleType="centerCrop"
        android:layout_marginStart="5dp"
        android:src="@drawable/clock" />

    <EditText
        android:id="@+id/selectTimeSlot"
        android:layout_width="wrap_content"
        android:layout_height="match_parent"
        android:layout_marginStart="5dp"
        android:gravity="center"
        android:hint="selcet any time" />
</LinearLayout>


```
Now In `MainActivity.java` file:    

```Java

public class MainActivity extends AppCompatActivity {

    DatePickerDialog DatePicker;
    TimePickerDialog TimePicker;
    private EditText selectTimeSlot,selectDate;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        selectDate = findViewById(R.id.selectDate);
        selectDate.setInputType(InputType.TYPE_NULL);

        selectDate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Calendar calendar = Calendar.getInstance();
                int day = calendar.get(Calendar.DAY_OF_MONTH);
                int month = calendar.get(Calendar.MONTH);
                int year = calendar.get(Calendar.YEAR);

                DatePicker = new DatePickerDialog(TrackSerial.this,
                        new DatePickerDialog.OnDateSetListener() {
                            @Override
                            public void onDateSet(android.widget.DatePicker view, int year, int monthOfYear, int dayOfMonth) {

                                Calendar calendar1 = Calendar.getInstance();
                                calendar1.set(Calendar.YEAR, year);
                                calendar1.set(Calendar.MONTH, monthOfYear);
                                calendar1.set(Calendar.DATE, dayOfMonth);

                                CharSequence dateCharSequence = DateFormat.format("EEEE, dd MMM yyyy", calendar1);
                                selectDate.setText(dateCharSequence);

                            }
                        }, year, month, day);
                DatePicker.show();
            }
        });

        selectTimeSlot = findViewById(R.id.selectTimeSlot);
        selectTimeSlot.setInputType(InputType.TYPE_NULL);

        selectTimeSlot.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Calendar calendar = Calendar.getInstance();
                int hour = calendar.get(Calendar.HOUR);
                int minute = calendar.get(Calendar.MINUTE);

                boolean is24HourFormat = DateFormat.is24HourFormat(TrackSerial.this);

                TimePicker = new TimePickerDialog(TrackSerial.this, new TimePickerDialog.OnTimeSetListener() {
                    @Override
                    public void onTimeSet(android.widget.TimePicker view, int hour, int minute) {

                        Calendar calendar1 = Calendar.getInstance();
                        calendar1.set(Calendar.HOUR, hour);
                        calendar1.set(Calendar.MINUTE, minute);

                        CharSequence charSequence = DateFormat.format("hh:mm a", calendar1);
                        selectTimeSlot.setText(charSequence);
                    }
                }, hour, minute, is24HourFormat);

                TimePicker.show();
            }
        });

    }
}


```
