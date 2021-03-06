package org.venity.jphp.ext.android.fx.support.event;

import javafx.animation.Animation;
import javafx.event.EventHandler;
import org.venity.jphp.ext.android.fx.support.EventProvider;

public class AnimationEventProvider extends EventProvider<Animation> {
    public Handler finishHandler() {
        return new Handler() {
            @Override
            public void set(Animation target, EventHandler eventHandler) {
                target.setOnFinished(eventHandler);
            }

            @Override
            public EventHandler get(Animation target) {
                return target.getOnFinished();
            }
        };
    }

    @Override
    public Class<Animation> getTargetClass() {
        return Animation.class;
    }
}
