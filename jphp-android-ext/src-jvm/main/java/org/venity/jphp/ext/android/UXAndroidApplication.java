package org.venity.jphp.ext.android;

import com.gluonhq.charm.glisten.application.MobileApplication;
import java.io.IOException;
import javafx.scene.Scene;

public class UXAndroidApplication extends MobileApplication {

    @Override
    public void postInit(Scene scene) throws IOException {
	StandaloneAndroidLoader loader = new StandaloneAndroidLoader();
	System.out.println("Starting JPHP android application");
        System.out.println("Code with love by venity");

        loader.setClassLoader(getClass().getClassLoader());
        loader.loadLibrary();
        loader.run();
    }
}
