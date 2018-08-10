package org.venity.jphp.ext.android;

import javafx.application.Application;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.geometry.Rectangle2D;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.input.Clipboard;
import javafx.scene.input.DataFormat;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.stage.Screen;
import javafx.stage.Stage;

import java.util.HashMap;
import java.util.Map;

public class UXAndroidApplication extends Application {

    @Override
    public void start(Stage stage) {
        try {
            System.out.println("Starting JPHP android application");
            System.out.println("Code with love by venity");

            StandaloneAndroidLoader loader = new StandaloneAndroidLoader();
            loader.setClassLoader(getClass().getClassLoader());
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

            TextArea errorArea = new TextArea(throwable.toString() + "\n\r" + trace.toString());

            root.getChildren().add(new Label("Java fatal error !"));
            root.getChildren().add(errorArea);

            HBox buttonsBox = new HBox();
            buttonsBox.setSpacing(8);

            Button hide = new Button("Hide");
            hide.setOnAction(event -> stage.hide());
            buttonsBox.getChildren().add(hide);

            Button copy = new Button("Copy error for report");
            copy.setOnAction(event -> {
                Map<DataFormat, Object> content = new HashMap<>();
                content.put(DataFormat.PLAIN_TEXT, errorArea.getText());
                Clipboard.getSystemClipboard().setContent(content);

                if (Clipboard.getSystemClipboard().getString().equals(errorArea.getText()))
                    copy.setText("OK");
            });
            buttonsBox.getChildren().add(copy);

            root.getChildren().add(buttonsBox);

            stage.setScene(new Scene(root, width, height));
	        stage.show();
        }
    }
}