package org.venity.jphp.ext.android.android.classes;

import com.gluonhq.charm.glisten.mvc.View;
import javafx.scene.Node;
import javafx.scene.layout.BorderPane;
import org.venity.jphp.ext.android.AndroidExtension;
import php.runtime.annotation.Reflection;
import php.runtime.env.Environment;
import php.runtime.reflection.ClassEntity;

@Reflection.Name("UXView")
@Reflection.Namespace(AndroidExtension.NS_ANDROID)
public class UXView extends UXMobileLayoutPane {

    public static final String HOME_NAME = "home";

    public UXView(Environment env, View wrappedObject) {
        super(env, wrappedObject);
    }

    public UXView(Environment env, ClassEntity clazz) {
        super(env, clazz);
    }
    
    @Reflection.Signature
    public void __construct(String name) {
        __wrappedObject = new View(name);
    }

    @Override
    public View getWrappedObject() {
        return (View) __wrappedObject;
    }

    @Reflection.Signature
    public boolean isShowing() {
        return getWrappedObject().isShowing();
    }

    @Reflection.Getter
    public String getName() {
        return getWrappedObject().getName();
    }

    @Reflection.Setter
    public void setName(String name) {
        getWrappedObject().setName(name);
    }
}
