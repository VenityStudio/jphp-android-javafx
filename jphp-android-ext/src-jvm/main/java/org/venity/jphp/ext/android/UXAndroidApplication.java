package org.venity.jphp.ext.android;

import com.gluonhq.charm.glisten.application.MobileApplication;
import java.io.IOException;
import javafx.scene.Scene;
import com.gluonhq.charm.glisten.control.ExceptionDialog;

public class UXAndroidApplication extends MobileApplication {

    @Override
    public void postInit(Scene scene) {
	try {
	    StandaloneAndroidLoader loader = new StandaloneAndroidLoader();
	    System.out.println("Starting JPHP android application");
            System.out.println("Code with love by venity");

            loader.setClassLoader(getClass().getClassLoader());
            loader.loadLibrary();
            loader.run();
	} catch (Exception e) {
	    ExceptionDialog d = new ExceptionDialog();	
	    d.setException(e);
	    d.showAndWait();	
	}	
    }
}
