package org.venity.jphp.ext.android;

import javafx.application.Application;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.geometry.Rectangle2D;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.VBox;
import javafx.stage.Screen;
import javafx.stage.Stage;
import php.runtime.memory.DoubleMemory;

public class UXAndroidApplication extends Application {

    @Override
    public void start(Stage stage) {
        try {
            System.out.println("Starting JPHP android application");
            System.out.println("Code with love by venity");

            StandaloneAndroidLoader loader = new StandaloneAndroidLoader();
            loader.setClassLoader(getClass().getClassLoader());
            loader.loadExtensions();
            loader.loadLibrary();

            loader.run();
        } catch (Throwable throwable)
        {
            Rectangle2D visualBounds = Screen.getPrimary().getVisualBounds();
            double width = visualBounds.getWidth();
            double height = visualBounds.getHeight();

            StringBuilder trace = new StringBuilder();

            for (StackTraceElement element: throwable.getStackTrace()) {
                trace.append(element.toString() + "\n");
            }

            VBox root = new VBox();
            root.setPadding(new Insets(8));
            root.setSpacing(8);
            root.setAlignment(Pos.CENTER);
            root.getChildren().add(new TextArea(throwable.toString() + "\n\r" + trace.toString()));
            root.getChildren().add(new Label("Fatal error " + throwable.getMessage()));

            Button hide = new Button("Hide");
            hide.setOnAction(event -> stage.hide());

            root.getChildren().add(hide);

            stage.setScene(new Scene(root, width, height));
	        stage.show();
        }
    }
}
